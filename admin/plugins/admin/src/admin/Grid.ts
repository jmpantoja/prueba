const _ = require('lodash')
const url = require('url')
import {AdminContext} from "../../types";
import {DataOptions} from 'vuetify/types'

type Filter = {
  type: string,
  value: string,
}

class AdminQueryNormalizer {

  private _options: object
  private _filters: object

  constructor(query: object) {
    this._options = {}
    this._filters = {}

    _.forOwn(query, (value: string, key: string) => {
      const isOption =
        this.setPageIfApplies(key, value) ||
        this.setPageSizeIfApplies(key, value) ||
        this.setOrderIfApplies(key, value)

      !isOption && this.setFilterIfApplies(key, value)
    })
  }

  private setPageIfApplies(key: string, value: string): boolean {
    if (key !== 'page') {
      return false
    }
    _.set(this._options, key, parseInt(value))
    return true
  }


  private setPageSizeIfApplies(key: string, value: string): boolean {
    if (key !== 'page_size') {
      return false
    }
    _.set(this._options, 'itemsPerPage', parseInt(value))
    return true
  }

  private setOrderIfApplies(key: string, value: string): boolean {
    const matches = key.match(/^order\[(.*)\]/i);

    if (!matches) {
      return false
    }

    var dir = 'desc' === value.toLowerCase();
    _.set(this._options, 'sortBy', [matches[1]])
    _.set(this._options, 'sortDesc', [dir])

    return true
  }

  private setFilterIfApplies(key: string, value: string) {
    const matches = key.match(/(.*)\[(.*)\]/)

    if (!matches) {
      _.merge(this._filters, {
        [key]: value
      })
      return
    }

    _.merge(this._filters, {
      [matches[1]]: {
        type: matches[2],
        value: value
      }
    })
  }

  options(): DataOptions {
    const options = _.pickBy(this._options, _.identity)
    return options
  }

  filters(): object {
    return this._filters
  }
}

class AdminQuery {

  private _options: DataOptions;
  private _filters: object;

  private static defaultOptions = {
    page: 1,
    itemsPerPage: 10,
    sortBy: [],
    sortDesc: [],
    groupBy: [],
    groupDesc: [],
    multiSort: false,
    mustSort: false
  }


  static make(options: DataOptions, filters: object): AdminQuery {
    return new AdminQuery(options, filters)
  }

  private constructor(options: DataOptions, filters: object) {
    this._options = options;
    this._filters = filters;
  }

  public static  get options(): DataOptions{
    return _.clone(AdminQuery.defaultOptions)
  }

  parse(): object {
    return {
      ...this.pageQuery,
      ...this.orderQuery,
      ...this.filterQuery
    }
  }

  private get pageQuery(): object {
    const defaultOptions = AdminQuery.options
    const page = {}
    if(this._options.page !== defaultOptions.page){
      _.set(page, 'page', this._options.page)
    }

    if(this._options.itemsPerPage !== defaultOptions.itemsPerPage){
      _.set(page, 'page_size',  this._options.itemsPerPage)
    }

    return page
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

abstract class Grid {
  private _context: AdminContext;

  private _headers: object[];
  private _actions: object[];
  private _items: object[];
  private _loading: boolean;
  private _panel: boolean;
  private _total: number;
  private _options: DataOptions;
  private _filters: object;

  public constructor(context: AdminContext) {
    const query = context.router.currentRoute.query;
    const normalizer = new AdminQueryNormalizer(query)

    this._context = context

    this._headers = []
    this._actions = []
    this._items = []
    this._loading = false
    this._panel = false
    this._total = 0
    this._options = normalizer.options()
    this._filters = normalizer.filters()

    this.initActions()
    this.initHeaders()
  }

  private initActions() {
    const actions = {
      edit: {
        icon: 'mdi-pencil',
        action: 'edit'
      },
      delete: {
        icon: 'mdi-delete',
        action: 'delete'
      }
    }

    this._actions = this._actions = _.chain(actions)
      .merge(this.actions)
      .values()
      .compact()
      .value();
  }

  private initHeaders() {
    let extraHeader = {}
    const length = Object.keys(this._actions).length

    if (length > 0) {
      extraHeader = {value: '__actions', sortable: false, width: 200, align: 'right'}
    }

    this._headers = _.chain(this.headers)
      .keyBy('value')
      .merge({
        __actions: extraHeader
      })
      .values()
      .value()
  }

  public get context(): AdminContext {
    return this._context
  }

  public abstract async fetch(query: object): Promise<object[]>;

  public abstract get headers(): object[];

  public get __headers(): object[] {
    return this._headers
  }

  public get actions(): object {
    return {}
  }

  public get __actions(): object[] {
    return _.pickBy(this._actions, _.identity);
  }

  public get loading() {
    return this._loading
  }

  public reload() {
    if (this._loading) {
      return
    }

    this._loading = true
    const query = AdminQuery.make(this._options, this._filters).parse()

    this.fetch(query)
      .then((response) => {
        this._items = _.get(response, 'hydra:member')
        this._total = _.get(response, 'hydra:totalItems')
        this._loading = false

        const path = url.format({
          query: query
        })
        this.context.router.push(path)

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

    if (this._options.page !== page) {
      this._options.page = page
      this.reload()
    }
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

  public filterBy(filters: object) {
    this._filters = filters
    this._options = AdminQuery.options
    this.showPanel = false
    this.reload()
  }


  edit(item: object) {
    alert('EDIT')
  }

  delete(item: object) {
    alert('DELETE')
  }

}

export default Grid;
