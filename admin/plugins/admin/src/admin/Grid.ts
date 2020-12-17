const _ = require('lodash')
import {AdminContext} from "../../types";
import {DataOptions} from 'vuetify/types'

type Filter = {
  type: string,
  value: string,
}

class QueryParser {
  private _options: DataOptions;
  private _filters: object;

  constructor(options: DataOptions, filters: object) {
    this._options = options;
    this._filters = filters;
  }

  parse(): object {
    return {
      ...this.pageQuery,
      ...this.orderQuery,
      ...this.filterQuery
    }
  }

  private get pageQuery(): object {
    return {
      page: this._options.page,
      page_size: this._options.itemsPerPage,
    }
  }

  private get orderQuery(): object {
    if (this._options.sortBy.length < 1) {
      return {}
    }

    const orderBy: string = this._options.sortBy[0]
    const key: string = `order[${orderBy}]`
    const dir: string = this._options.sortDesc[0] === false ? 'asc' : 'desc'

    let order = {[key]: dir}
    return order
  }

  private get filterQuery(): object {
    let normalized = {};

    _.forOwn(this._filters, (filter: Filter, name: string) => {
      const type = filter.type
      const value = filter.value
      const key = type ? `${name}[${type}]` : name
      const item = value ? {[key]: value} : {}
      _.merge(normalized, item)
    });

    return normalized
  }

}

const options = {
  page: 1,
  itemsPerPage: 10,
  sortBy: [],
  sortDesc: [],
  groupBy: [],
  groupDesc: [],
  multiSort: false,
  mustSort: false
}

abstract class Grid {


  private _context: AdminContext;
  protected _items: object[];
  private _panel: boolean;
  private _total: number;
  private _options: DataOptions;
  private _filters: object;

  public constructor(context: AdminContext) {
    this._context = context
    this._items = []
    this._panel = false
    this._total = 0
    this._options = options
    this._filters = {}
  }

  public get context(): AdminContext {
    return this._context
  }

  public abstract async fetch(query: object): Promise<object[]>;

  public restart() {
    this._options = options
  }

  public reload() {
    const query = new QueryParser(this._options, this._filters)
    this.fetch(query.parse())
      .then((response) => {
        this._items = _.get(response, 'hydra:member')
        this._total = _.get(response, 'hydra:totalItems')
      })
  }

  public get items(): object[] {
    return this._items
  }

  public get total(): number {
    return this._total
  }

  public get page(): number {
    return this._options.page
  }

  public set page(page) {
    this._options.page = page
  }

  public get options(): DataOptions {
    return this._options
  }

  public set options(options) {
    this._options = options
    this.reload()
  }

  public get showPanel(): boolean {
    return this._panel;
  }

  public set showPanel(value) {
    this._panel = value;
  }

  public togglePanel() {
    this._panel = !this._panel;
  }

  public reset() {
    this._filters = {}
    this.reload()
  }

  public filterBy(filters: object) {
    this._filters = filters
    this.showPanel = false
    console.log(filters)
    this.reload()
  }


}

export default Grid;
