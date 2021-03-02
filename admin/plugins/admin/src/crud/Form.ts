import App from "~/plugins/admin/src/app/App";
import Crud from "~/plugins/admin/src/crud/Crud";
import Dialog from "~/plugins/admin/src/crud/Dialog";
import Item from "~/plugins/admin/src/crud/Item";


const _ = require('lodash')

class Form extends Dialog {
  private _valid: boolean;
  private _item: Item | null;
  private _schema: object = {}

  public constructor(context: App, crud: Crud) {
    super(context, crud)

    this._valid = false
    this._item = null
  }

  get actionName(): string {
    if (this._item) {
      return this._item.id ? 'edit' : 'create'
    }

    return 'create'
  }

  public get valid(): boolean {
    return this._valid;
  }

  public set valid(valid: boolean) {
    this._valid = valid;
  }

  public set schema(schema: object) {
    this._schema = schema;
  }

  public get schema(): object {
    return this._schema;
  }

  public show(item: Item | null) {
    this._item = _.cloneDeep(item)
    return super.show(item)
  }

  public get title() {
    return `dialog.${this.actionName}.title`
  }

  public get item(): object {
    return this._item || this.default;
  }

  public get default(): object {
    return this._crud.default
  }

}

export default Form;
