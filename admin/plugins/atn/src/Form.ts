import {
  AdminContext,
  ApiClient,
  Button,
  ButtonList,
  ButtonOptionsList,
  EventDispatcher,
  FormGroup,
  FormNormalizer,
  FormOptions,
  Record,
  UrlManager
} from "~/plugins/atn/src/index";

const _ = require('lodash')

class Form {
  private _namespace: string;
  private _item: Record;
  private _default: Record;
  private _client: ApiClient;
  private _urlManager: UrlManager;
  private _dispatcher: EventDispatcher;
  private _visible: boolean = false;
  private _valid: boolean = false;
  private _width: number;
  private _height: number;
  private _loading: boolean;
  private _groups: FormGroup[];
  private _buttons: ButtonList;


  public constructor(namespace: string, context: AdminContext, options: FormOptions) {
    this._namespace = namespace;
    this._client = context.client
    this._urlManager = context.urlManager

    this._dispatcher = context.dispatcher
    this._width = options.width || 750
    this._height = options.height || 500
    this._loading = false
    this._default = options.default || {id: null};
    this._item = _.cloneDeep(this._default)

    this._groups = FormNormalizer.normalize(options.groups)
    this._buttons = this.initButtons(options.buttons)
  }

  private initButtons(actions?: ButtonOptionsList): ButtonList {
    const entries = Object
      .entries(actions || {})
      .map(([key, options]) => {
        const button = new Button(this._namespace, options)
        return [key, button]
      })

    return Object.fromEntries(entries)
  }


  public get namespace(): string {
    return this._namespace;
  }

  public get valid(): boolean {
    return this._valid;
  }

  public set valid(value: boolean) {
    this._valid = value;
  }

  public set visible(value: boolean) {
    this._visible = value;
    if (!value) {
      this._urlManager.clearAction()
    }
  }

  public get visible(): boolean {
    return this._visible;
  }

  public get title(): string {
    if(this.editMode){
      return 'form.title.edit';
    }
    return 'form.title.create';
  }

  public get groups(): FormGroup[] {
    return this._groups;
  }

  public get width(): number {
    return this._width;
  }

  public get height(): number {
    return this._height;
  }


  public get loading(): boolean {
    return this._loading;
  }

  public get item(): Record {
    return this._item
  }

  public get buttons(): ButtonList {
    return this._buttons;
  }

  public get editMode(): boolean {
    return !!this.item.id
  }

  public get createMode(): boolean {
    return !this.editMode
  }

  public save(item: Record): Promise<Record> {
    this._item = item
    if (this.editMode) {
      return this.update(item)
    }
    return this.create(item)
  }

  private update(item: Record): Promise<Record> {
    return this._client.update(item)
      .loading((value) => {
        this._loading = value
      })
      .success((item: Record) => {
        this._dispatcher.emit(`${this._namespace}.post.save`, item)
        return item
      })
      .end(() => {
        this._visible = false
      })
      .run()
  }

  private create(item: Record): Promise<Record> {
    return this._client.create(item)
      .loading((value) => {
        this._loading = value
      })
      .success((item: Record) => {
        this._dispatcher.emit(`${this._namespace}.post.save`, item)
        return item
      })
      .end(() => {
        this._visible = false
      })
      .run()
  }

  public delete(item: Record): Promise<Record> {
    return this._client.delete(item)
      .loading((value) => {
        this._loading = value
      })
      .success((item: Record) => {
        this._dispatcher.emit(`${this._namespace}.post.delete`, item)
        return item
      })
      .end(() => {
        this._visible = false
      })
      .run()
  }

  public show(item?: Record) {
    this.urlAction(item);

    if (!item || !item.id) {
      this._item = _.cloneDeep(this._default)
      this._visible = true
      return;
    }

    this._client.item(item.id)
      .run()
      .then((response) => {
        this._item = _.cloneDeep(response)
        this._visible = true
        this._loading = false
      })
  }


  private urlAction(item?: Record) {
    const name = item ? 'edit' : 'create'
    const id = item ? item.id : null
    this._urlManager.setAction({
      namespace: this._namespace,
      name,
      id
    })
  }
}

export default Form;
