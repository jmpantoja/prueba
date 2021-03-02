import {ActionList, ApiClient, EventDispatcher, FormLayout, FormMapper, Record} from ".";

type Context = {
  mapper: FormMapper,
  client: ApiClient,
  dispatcher: EventDispatcher,
  item: Record
}

class Form {
  private _dispatcher: EventDispatcher;
  private readonly _client: ApiClient;

  private readonly _width: number;
  private readonly _layout: FormLayout;
  private readonly _actions: ActionList;

  private _editTitle: string;
  private _createTitle: string;
  private _loading: boolean = false;
  private _visible: boolean = false;
  private _valid: boolean = false;
  private _item: Record;

  constructor(options: Context) {
    const mapper = options.mapper;
    this._dispatcher = options.dispatcher
    this._client = options.client

    this._editTitle = mapper.editTitle
    this._createTitle = mapper.createTitle
    this._width = mapper.width
    this._layout = mapper.layout
    this._actions = mapper.actions
    this._valid = false

    this._item = options.item

    this._dispatcher.subscribe(this._actions)

  }

  public get title(): string {
    if (this.item.id) {
      return this._editTitle
    }

    return this._createTitle
  }

  public get loading(): boolean {
    return this._loading
  }

  public get visible(): boolean {
    return this._visible;
  }

  public set visible(value: boolean) {
    this._visible = value;
  }

  public get valid(): boolean {
    return this._valid;
  }

  public set valid(value: boolean) {
    this._valid = value;
  }

  public get width(): number {
    return this._width
  }

  public get layout(): FormLayout {
    return this._layout;
  }

  public get actions(): ActionList {
    return this._actions;
  }

  public load(item: Record) {
    return this._client.findOne(`${item.id}`, {
      loading: (loading: boolean) => {
        this._loading = loading
      },
      then: (response: Record) => {
        this._item = response
        this.visible = true
      }
    })
  }

  public save(item: Record): Promise<Record> {
    return this._client.update(item, {
      loading: (loading: boolean) => {
        this._loading = loading
      },
      then: (item: Record) => {
        this._item = item
        this._visible = false
        this._dispatcher.emit('reload', this._item)
        return this._item
      }
    })
  }

  public delete(item: Record): Promise<Record> {
    return this._client.remove(item, {
      loading: (loading: boolean) => {
        this._loading = loading
      },
      then: (item: Record) => {
        this._visible = false
        this._dispatcher.emit('reload')
        return null
      }
    })
  }


  public get item() {
    return this._item
  }
}

export default Form;
