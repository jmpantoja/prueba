import {Locale} from '../ui'
import {NuxtAxiosInstance} from "@nuxtjs/axios";
import {
  AdminContext,
  ApiClient,
  Dialog,
  EventDispatcher,
  FilterMapper,
  Flash,
  Form,
  FormMapper,
  Grid,
  GridMapper,
  Record,
  Toolbar,
  ToolbarMapper,
} from ".";


type Context = {
  locale: Locale,
  axios: NuxtAxiosInstance
}

abstract class Admin {
  private readonly _client: ApiClient;
  private readonly _locale: Locale;
  private readonly _dispatcher: EventDispatcher;
  private readonly _grid: Grid;
  private readonly _filters: FilterMapper;
  private readonly _gridMapper: GridMapper;
  private readonly _formMapper: FormMapper;
  private readonly _form: Form;
  private readonly _toolbarMapper: ToolbarMapper;
  private readonly _toolbar: Toolbar;
  private readonly _flash: Flash;
  private readonly _dialog: Dialog;


  public constructor(context: Context) {
    this._dispatcher = new EventDispatcher(this.context)

    this._client = new ApiClient(context.axios, this._dispatcher)
    this._locale = context.locale

    this._filters = new FilterMapper();
    this._dialog = new Dialog()
    this._gridMapper = new GridMapper();
    this._formMapper = new FormMapper();
    this._toolbarMapper = new ToolbarMapper();

    this.configure()

    this._toolbar = new Toolbar({
      mapper: this._toolbarMapper
    })

    this._grid = new Grid({
      mapper: this._gridMapper,
      client: this._client,
      dispatcher: this._dispatcher
    })

    this._form = new Form({
      mapper: this._formMapper,
      client: this._client,
      dispatcher: this._dispatcher,
      item: this.itemByDefault()
    })

    this._flash = new Flash(this._dispatcher)

    this._dispatcher.bind(this.context)
  }

  private configure() {
    this.setUpClient(this._client)
    this.setUpToolbar(this._toolbarMapper)
    this.setUpFilters(this._filters)
    this.setUpGrid(this._gridMapper)
    this.setUpForm(this._formMapper)
  }

  protected abstract setUpClient(client: ApiClient): void

  protected abstract setUpToolbar(mapper: ToolbarMapper): void;

  public get toolbar(): Toolbar {
    return this._toolbar;
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


  protected abstract itemByDefault(): Record

  protected abstract toString(item: Record): string

  public get client(): ApiClient {
    return this._client;
  }

  public get dispatcher(): EventDispatcher {
    return this._dispatcher;
  }

  public get dialog(): Dialog {
    return this._dialog;
  }

  public get flash(): Flash {
    return this._flash;
  }

  public get context(): AdminContext {
    return {
      client: this.client,
      grid: this.grid,
      form: this.form,
      flash: this.flash,
      dialog: this.dialog,
      toString: this.toString
    }

  }
}

export default Admin;
