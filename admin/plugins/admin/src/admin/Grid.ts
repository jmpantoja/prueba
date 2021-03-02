import {DataOptions, DataTableHeader} from "vuetify/types";
import {ActionList, ApiClient, ApiRequest, Dataset, EventDispatcher, FilterList, GridMapper, Record} from ".";


const _ = require('lodash')

type GridContext = {
  mapper: GridMapper,
  client: ApiClient,
  dispatcher: EventDispatcher
}

class Grid {
  private _dispatcher: EventDispatcher;
  private _client: ApiClient;
  private _filters: FilterList

  private readonly _headers: Array<DataTableHeader>
  private _items: Array<Record>

  private _loading: boolean;
  private _options: DataOptions;
  private _page: number;
  private _pageCount: number;
  private _total: number;
  private _actions: ActionList;


  public constructor(options: GridContext) {
    const mapper = options.mapper;

    this._client = options.client;
    this._dispatcher = options.dispatcher
    this._filters = {}

    this._headers = mapper.headers
    this._actions = mapper.actions
    this._items = []

    this._loading = false;
    this._options = mapper.options;
    this._page = mapper.options.page;
    this._pageCount = 0;
    this._total = 0;

    this._dispatcher.subscribe(this._actions)

    this._dispatcher.on('reload', () => {
      this.reload()
    })
  }

  public reload(): void {
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

  public get actions(): ActionList {
    return this._actions;
  }

  public get items(): Array<Record> {
    return this._items
  }

  public get loading(): boolean {
    return this._loading;
  }

  public get options(): DataOptions {
    return this._options;
  }

  public set options(options: DataOptions) {
    this._options = options;
    this.reload()
  }

  public get total(): number {
    return this._total;
  }

  public get page(): number {
    return this._page;
  }

  public set page(page: number) {
    this._page = page;
  }

  public get pageCount(): number {
    return this._pageCount;
  }

  public set pageCount(pageCount: number) {
    this._pageCount = pageCount;
  }

}


export default Grid
