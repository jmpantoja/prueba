import {Locale} from '../ui'
import {NuxtAxiosInstance} from "@nuxtjs/axios";
import {ApiClient, FilterMapper, Form, FormMapper, Grid, GridMapper} from ".";


type Context = {
  locale: Locale,
  axios: NuxtAxiosInstance
}

abstract class Admin {
  private readonly _client: ApiClient;
  private readonly _locale: Locale;
  private readonly _messages: Map<string, string>;
  private readonly _grid: Grid;
  private readonly _filters: FilterMapper;
  private readonly _gridMapper: GridMapper;
  private readonly _formMapper: FormMapper;
  private readonly _form: Form;


  public constructor(context: Context) {
    this._client = new ApiClient(context.axios)
    this._locale = context.locale

    this._filters = new FilterMapper();
    this._gridMapper = new GridMapper();
    this._formMapper = new FormMapper();

    this._messages = new Map<string, string>()
    this.configure()

    this._grid = new Grid(this._client, this._gridMapper)
    this._form = new Form(this._client, this._formMapper)
  }

  private configure() {
    this.setUpMessages(this._messages)
    this.setUpClient(this._client)
    this.setUpFilters(this._filters)
    this.setUpGrid(this._gridMapper)
    this.setUpForm(this._formMapper)
  }

  protected abstract setUpClient(client: ApiClient): void

  protected abstract setUpMessages(messages: Map<string, string>): void;

  public message(key: string) {
    const text = this._messages.get(key) || ''
    return this._locale.translate(text)
  }

  protected abstract setUpGrid(mapper: GridMapper): void

  public get grid(): Grid {
    return this._grid
  }

  protected abstract setUpForm(mapper: FormMapper): void

  public get form(): Form {
    return this._form
  }

  protected abstract setUpFilters(mapper: FilterMapper): void

  public get filters(): FilterMapper {
    return this._filters
  }
}

export default Admin;
