import {ValidatorResult} from "jsonschema";

const Validator = require('jsonschema').Validator;
const _ = require('lodash');

type InputField = { type: object, label: string, props: Array<any> };
type InputRow = { break: boolean, fields: Array<InputField> };
type InputTab = { label: string, rows: Array<InputRow> };

const field = {
  id: '/Field',
  type: 'object',
  properties: {
    label: {type: 'string'},
    type: {type: 'object'}
  },
  required: ['type', 'label']
}

const cell = {
  id: '/Cell',
  type: 'object',
  properties: {
    fields: {
      type: 'object',
      patternProperties: {
        ".*": {$ref: "/Field"},
      },
    }
  },
  required: ['fields']
}

const tab = {
  id: '/Tab',
  type: 'object',
  properties: {
    label: {type: "string"},
    rows: {
      type: 'array',
      items: {$ref: "/Cell"}
    }
  },
  required: ['label', 'rows']
}


const schema = {
  type: 'object',
  properties: {
    tabs: {
      type: 'array',
      items: {$ref: "/Tab"}
    },
    rows: {
      type: 'array',
      items: {$ref: "/Cell"}
    }
  },
  required: ['tabs', 'rows']
}

class FormValidator {
  private _validator: ValidatorResult;
  private _instance: { rows: Array<object>, tabs: Array<object> };

  public constructor(value: object) {
    this._instance = {
      rows: [],
      tabs: []
    }

    value = _.defaults(value, {
      rows: [],
      tabs: []
    })

    const validator = new Validator()

    validator.addSchema(field, '/Field')
    validator.addSchema(cell, '/Cell')
    validator.addSchema(tab, '/Tab')

    this._validator = validator.validate(value, schema)

    this.initialize()
  }

  public get valid(): boolean {
    return this._validator.valid
  }

  public get errors() {
    return this._validator.errors
  }

  public get instance() {
    return this._instance
  }


  private initialize(): void {
    if (!this.valid) {
      return
    }

    const instance = this._validator.instance;

    this._instance.tabs = instance.tabs.map((tab: InputTab) => {
      return {
        label: tab.label,
        rows: this.normalizeLayout(tab.rows)
      }
    })

    this._instance.rows.push(...this.normalizeLayout(instance.rows))

  }

  private normalizeLayout(input: Array<InputRow>): Array<any> {

    const temp = input.map((row: InputRow) => {
      return {
        props: _.omit(row, ['fields', 'break']),
        break: row['break'] || false,
        fields: _.mapValues(row['fields'], (field: InputField) => this.normalizeField(field)),
      }
    })

    const rows = [[]];
    let index = 0;

    temp.forEach((cell: { break: boolean }) => {
      rows[index] = _.concat(rows[index], _.omit(cell, 'break'))

      if (cell.break) {
        index++
        rows[index] = []
      }
    })

    return _.filter(rows, (row: Array<any>) => {
      return row.length > 0
    });
  }

  private normalizeRow(row: InputRow): object {

    return {
      props: _.omit(row, ['fields', 'break']),
      break: row['break'] || false,
      fields: _.mapValues(row['fields'], (field: InputField) => this.normalizeField(field)),
    }
  }

  private normalizeField(field: InputField): object {
    return {
      type: field['type'],
      label: field['label'],
      props: _.omit(field, ['type', 'label'])
    }
  }
}

export default FormValidator;
