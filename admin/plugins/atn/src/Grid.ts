import {
  AdminContext,
  ApiClient,
  Button,
  ButtonList,
  ButtonOptionsList,
  Column,
  ColumnList,
  DataGridRequest,
  Dataset,
  defaultDataOptions,
  FilterFieldList,
  FilterList,
  GridDataOptions,
  GridOptions,
  Record
} from "~/plugins/atn/src/index";

import {DataOptions} from "vuetify/types";
import UrlManager from "~/plugins/atn/src/UrlManager";

const _ = require('lodash')


const actionsColumn: Column = {
  text: false,
  key: '__actions',
  width: '150px',
  align: 'center',
  sortable: false
};

class Grid {
  private readonly _columns: Array<Column>;
  private _client: ApiClient;
  private _urlManager: UrlManager;

  private _initialized: boolean = false;
  private _items: Array<Record> = [];
  private _filters: FilterList = {}
  private _filtersFields: FilterFieldList;
  private _filtersDefault: object;
  private _buttons: ButtonList
  private _loading: boolean = false;
  private _options: DataOptions;
  private _optionsDefault: DataOptions;

  private _total: number = 0
  private _page: number = 1
  private _pageCount: number = 0


  constructor(context: AdminContext, options: GridOptions) {
    this._client = context.client
    this._urlManager = context.urlManager

    this._optionsDefault = this.initOptionsDefault(options.options)
    this._options = this.initOptions()
    this._columns = this.initColumns(options.columns, options.buttons)

    this._filtersFields = this.initFilters(options.filters)
    this._filtersDefault = this.initFiltersDefault(options.filters)
    this._buttons = this.initButtons(options.buttons)

    this._page = this._options.page
    this._filters = this._urlManager.dataFilters

    this.reload()
  }

  private initOptionsDefault(options?: GridDataOptions): DataOptions {
    return {
      ...defaultDataOptions,
      ...options || {},
    }
  }

  private initOptions(options?: GridDataOptions): DataOptions {
    return {
      ...this._optionsDefault,
      ...this._urlManager.dataOptions
    }
  }

  private initColumns(columns: ColumnList, buttons?: ButtonOptionsList): Array<Column> {

    const hasButtons = Object.values(buttons || {}).length > 0
    const temp = Object.values(columns)
    if (hasButtons) {
      temp.push(actionsColumn)
    }
    return temp.map((column: Column) => {
      return {
        text: column.key,
        value: column.key,
        sortable: false,
        type: 'atn-grid-text',
        ...column
      }
    })
  }

  private initFilters(fields?: FilterFieldList): FilterFieldList {
    const entries = Object
      .values(fields || {})
      .map((options) => {
        const field = {
          label: options.key,
          type: 'atn-filter-text',
          value: null,
          ...options,
        }
        return [options.key, field]
      })

    return Object.fromEntries(entries)
  }

  private initFiltersDefault(fields?: FilterFieldList): object {
    const entries = Object
      .values(fields || {})
      .map((field) => {
        return [field.key, field.value]
      })

    return Object.fromEntries(entries)
  }

  private initButtons(actions?: ButtonOptionsList): ButtonList {
    const entries = Object
      .entries(actions || {})
      .map(([key, options]) => {
        const action = new Button(options)
        return [key, action]
      })

    return Object.fromEntries(entries)
  }

  public get columns(): Column[] {
    return this._columns;
  }

  public get items(): Array<Record> {
    return this._items;
  }

  public get loading(): boolean {
    return this._loading;
  }

  public get options(): DataOptions {
    return this._options;
  }

  public set options(value: DataOptions) {
    this._options = value;
    if (this._initialized) {
      this.reload()
    }
  }

  public get total(): number {
    return this._total;
  }

  public get page(): number {
    return this._page;
  }

  public set page(value: number) {
    this._page = value;
  }

  public get pageCount(): number {
    return this._pageCount;
  }

  public set pageCount(value: number) {
    this._pageCount = value;
  }

  public set filters(filters: FilterList) {
    this._options.page = 1
    this._filters = filters
    this.reload()
  }

  public get filterFields(): FilterFieldList {
    return this._filtersFields
  }

  public get filtersDefault(): object {
    return _.cloneDeep(this._filtersDefault);
  }

  public get buttons(): ButtonList {
    return this._buttons;
  }

  public reset() {
    this._options = _.cloneDeep(this._optionsDefault)
    this._filters = _.cloneDeep(this._filtersDefault)
    this.reload()
  }

  public reload() {

    const params = DataGridRequest.normalize(this._options, this._filters);
    this._urlManager.update(params)

    this._client.read(params)
      .loading((value) => {
        this._loading = value
      })
      .success((dataset: Dataset) => {
        this._initialized = true
        this._total = dataset.total
        this._items = dataset.items
      })
      .run()
  }
}

export default Grid
