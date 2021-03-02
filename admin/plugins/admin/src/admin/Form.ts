import {ApiClient, FormActionList, FormLayout, FormMapper, Record, eventBus} from ".";

class Form {
  private readonly _client: ApiClient;
  private readonly _width: number;
  private readonly _layout: FormLayout;
  private readonly _actions: FormActionList;

  private _loading: boolean = false;
  private _visible: boolean = false;
  private _item: Record;


  constructor(client: ApiClient, mapper: FormMapper) {
    this._client = client
    this._width = mapper.width
    this._layout = mapper.layout
    this._actions = mapper.actions

    this._item = {
      id: 'sss',
      fullName: {
        firstName: 'jose antonio',
        lastName: 'gonzales garcia'
      },
      birthDate: new Date()
    }

  }

  public get title(): string {
    return 'Editar'
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

  public get width(): number {
    return this._width
  }

  public get layout(): FormLayout {
    return this._layout;
  }

  public get actions(): FormActionList {
    return this._actions;
  }

  public load(item: Record) {
    this._client.get({
      id: item.id,
      loading: (loading: boolean) => {
        this._loading = loading
      },
      then: (item: Record) => {
        this._item = item
        this._visible = true
      }
    });
  }

  public save(item: Record) {
    this._client.update({
      item: item,
      loading: (loading: boolean) => {
        this._loading = loading
      },
      then: (item: Record) => {
        this._item = item
        this._visible = false
        eventBus.$emit('onChangeDataSet')
      }
    });
  }

  public get item() {
    return this._item
  }
}

export default Form;
