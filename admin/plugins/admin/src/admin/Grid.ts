import {DataOptions, DataTableHeader} from "vuetify/types";
import {ApiClient, ApiRequest, Dataset, defaultDataOptions, FilterList, ItemActionList, Record} from ".";
import GridMapper from "~/plugins/admin/src/admin/GridMapper";

const _ = require('lodash')

class Grid {
  private _client: ApiClient;
  private _filters: FilterList

  private readonly _headers: Array<DataTableHeader>
  private _items: Array<Record>

  private _loading: boolean;
  private _options: DataOptions;
  private _page: number;
  private _pageCount: number;
  private _total: number;
  private _actions: ItemActionList;

  public constructor(client: ApiClient, mapper: GridMapper) {
    this._client = client;
    this._filters = {}

    this._headers = mapper.headers
    this._actions = mapper.actions
    this._items = []

    this._loading = false;
    this._options = mapper.options;
    this._page = mapper.options.page;
    this._pageCount = 0;
    this._total = 0;
  }

  private reload(): void {
    const params = ApiRequest.normalize(this._options, this._filters);
    this._client.read({
      params: params,
      loading: (loading: boolean) => {
        this._loading = loading
      },
      then: (response: Dataset) => {
        this._total = response.total;
        this._items = response.items;
      }
    })
  }

  public set filters(filters: FilterList) {
    this._filters = filters
    this.reload()
  }

  public get headers() {
    return this._headers
  }

  get actions(): ItemActionList {
    return this._actions;
  }

  public get items(): Array<Record> {
    return this._items
  }

  get loading(): boolean {
    return this._loading;
  }

  get options(): DataOptions {
    return this._options;
  }

  set options(options: DataOptions) {
    this._options = options;
    this.reload()
  }

  get total(): number {
    return this._total;
  }

  get page(): number {
    return this._page;
  }

  set page(page: number) {
    this._page = page;
  }

  get pageCount(): number {
    return this._pageCount;
  }

  set pageCount(pageCount: number) {
    this._pageCount = pageCount;
  }
}


export default Grid
