import {DataOptions} from 'vuetify/types'
import VueRouter from "vue-router";
import Item from "~/plugins/admin/src/admin/Item";

const _ = require('lodash')
const url = require('url')


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

  options(): DataOptions {
    const options = _.pickBy(this._options, _.identity)
    return options
  }

  filters(): object {
    return this._filters
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
    if ('action' === key) {
      return;
    }

    const matches = key.match(/(.*)\[(.*)\]/)

    if (!matches) {
      this.setSimpleFilter(key, value);
      return
    }
    this.setComplexFilterIfApplies(matches[1], matches[2], value)
  }

  private setSimpleFilter(key: string, value: string) {
    _.merge(this._filters, {
      [key]: value
    })
  }

  private setComplexFilterIfApplies(name: string, type: string, value: string) {

    _.merge(this._filters, {
      [name]: {
        type,
        value
      }
    })
  }

  public removeFilter(actionName: string) {
    _.unset(this._filters, 'action')
  }

}

class AdminQuery {
  private _defaultOptions: DataOptions;
  private _filters: object;
  private _action: string | null;
  private _id: string | null;

  private static _defaultOptions = {
    page: 1,
    itemsPerPage: 10,
    sortBy: [],
    sortDesc: [],
    groupBy: [],
    groupDesc: [],
    multiSort: false,
    mustSort: false
  }

  static make(options: DataOptions, filters: object, actionId: { action: string, id: string } | null): AdminQuery {
    return new AdminQuery(options, filters, actionId)
  }


  private constructor(options: DataOptions, filters: object, actionId: { action: string, id: string } | null) {
    this._defaultOptions = options;
    this._filters = filters;
    this._action = _.get(actionId, 'action')
    this._id = _.get(actionId, 'id')
  }


  public static get defaultOptions(): DataOptions {
    return _.clone(AdminQuery._defaultOptions)
  }

  private get pageQuery(): object {
    const defaultOptions = AdminQuery.defaultOptions
    const page = {}
    if (this._defaultOptions.page !== defaultOptions.page) {
      _.set(page, 'page', this._defaultOptions.page)
    }

    if (this._defaultOptions.itemsPerPage !== defaultOptions.itemsPerPage) {
      _.set(page, 'page_size', this._defaultOptions.itemsPerPage)
    }

    return page
  }

  private get orderQuery(): object {
    if (this._defaultOptions.sortBy.length < 1) {
      return {}
    }

    const orderBy: string = this._defaultOptions.sortBy[0]
    const key: string = `order[${orderBy}]`
    const dir: string = this._defaultOptions.sortDesc[0] === false ? 'asc' : 'desc'

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

  parse(): object {
    return {
      ...this.pageQuery,
      ...this.orderQuery,
      ...this.filterQuery
    }
  }
}


class AdminUrl {
  private _normalizer: AdminQueryNormalizer
  private _router: VueRouter;

  public constructor(router: VueRouter) {
    this._router = router
    this._normalizer = new AdminQueryNormalizer(this.query)
  }

  public get query() {
    return url.parse(document.location.href, true).query;
  }

  public get defaultOptions(): DataOptions {
    return AdminQuery.defaultOptions
  }

  public options(): DataOptions {
    return this._normalizer.options()
  }

  public filters(): object {
    return this._normalizer.filters()
  }

  public removeAction(action: string) {
    const actionName = `action[${action}]`
    const query = _.pickBy(this.query, (value: string, key: string) => {
      return key !== actionName
    });

    this._normalizer.removeFilter(actionName)

    this.goTo(query)
  }

  addAction(action: string, item: Item | null) {
    const query = _.cloneDeep(this.query)
    const actionName = `action[${action}]`
    query[actionName] = item ? item.id || 'true' : 'true'

    this.goTo(query)
  }

  public hasAction(actions: string[]): boolean {
    const query = this.query
    let exists = false
    actions.forEach((action: string) => {
      const actionName = `action[${action}]`
      exists = exists || _.has(query, actionName)
    })
    return exists
  }

  public getActionId(): { action: string, id: string } | null {
    let actions = null

    _.forOwn(this.query, (value: string, key: string) => {
      var matches = key.match('action\\[(.*)\\]');
      if (matches) {
        const action = matches[1]
        actions = {
          action,
          id: value
        }
      }
    });

    return actions;
  }

  public parse(options: DataOptions, filters: object) {
    return AdminQuery.make(options, filters, this.getActionId()).parse()
  }

  public goTo(query: object) {
    const path = url.format({
      query
    })
    this._router.push(path)
  }
}

export default AdminUrl
