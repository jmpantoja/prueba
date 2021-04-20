import {AppContext, FilterList, UrlAction, UrlEntry} from "~/plugins/atn/src/index";
import VueRouter from "vue-router";

const _ = require('lodash')
const url = require('url')

type DataOptions = {
  sortBy: string[],
  sortDesc: boolean[],
  page?: number,
  itemsPerPage?: number,
}

class UrlNormalizer {
  private _options: DataOptions = {
    sortBy: [],
    sortDesc: [],
  };

  private _namespace: string;
  private _filters: FilterList = {};
  private _action?: UrlAction;


  private static createEntry(field: string, value: any): UrlEntry {
    const matches = field.match(/^(.*)\[(.*)\]/i);
    let name = field
    let key = null

    if (matches) {
      name = matches[1]
      key = matches[2]
    }

    return {
      name,
      key,
      value
    }
  }

  public static fromQuery(namespace: string, query: object) {
    const entries = Object.entries(query)
      .map(([field, value]) => {
        return this.createEntry(field, value);
      })

    return new UrlNormalizer(namespace, entries)
  }

  private constructor(namespace: string, entries: UrlEntry[]) {
    this._namespace = namespace

    entries.forEach((entry: UrlEntry) => {
      this.sortEntry(entry)
      this.pageEntry(entry)
      this.actionEntry(entry)
      this.filterEntry(entry)
    })
  }

  private sortEntry(entry: UrlEntry) {
    if (entry.name !== 'order') {
      return
    }
    this._options.sortBy.push(entry.key || '')
    this._options.sortDesc.push(entry.value === 'desc')
  }

  private pageEntry(entry: UrlEntry) {
    if (entry.name === 'page') {
      this._options.page = entry.value * 1
    }

    if (entry.name === 'page_size') {
      this._options.itemsPerPage = entry.value * 1
    }
  }

  private actionEntry(entry: UrlEntry) {
    if (entry.name !== 'action') {
      return
    }

    this._action = {
      namespace: this._namespace,
      name: entry.key || '',
      id: entry.value,
    }
  }


  private filterEntry(entry: UrlEntry) {
    if (['order', 'page', 'page_size', 'action'].includes(entry.name)) {
      return
    }

    this._filters[entry.name] = {
      type: entry.key || '',
      value: entry.value
    }
  }

  public get options(): DataOptions {
    return this._options;
  }

  public get filters(): FilterList {
    return this._filters;
  }

  public get action(): UrlAction | undefined {
    return this._action;
  }
}

class UrlManager {
  private _router: VueRouter;
  private _normalizer: UrlNormalizer;


  public constructor(namespace: string, context: AppContext) {
    this._router = context.router
    this._normalizer = UrlNormalizer.fromQuery(namespace, this.query)
  }

  private get query(): object {
    return this._router.currentRoute.query;
  }

  public clearAction() {
    const entries = Object.entries(this.query)
      .filter(([key, value]) => {
        return !key.match(/action\[.*\]/)
      })

    this.push(Object.fromEntries(entries))

  }

  public setAction(action: UrlAction) {

    const query = {
      ...this.query,
      ...this.actionToArg(action)
    }
    this.push(query)
  }

  private actionToArg(action?: UrlAction) {
    if (!action) {
      return {}
    }

    const key = `action[${action.name}]`
    const value = action.id

    return {
      [key]: value
    }
  }

  public get dataOptions() {
    return this._normalizer.options
  }

  public get dataFilters() {
    return this._normalizer.filters
  }

  public get urlAction() {
    return this._normalizer.action
  }

  public update(params: object) {
    const query = {
      ...params,
      ...this.actionToArg(this.urlAction)
    }
    this.push(query);
  }

  private push(query: {}) {
    const path = url.format({
      query
    })

    this._router.push(path)
  }
}

export default UrlManager
