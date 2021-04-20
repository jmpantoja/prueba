import {
  ActionContext,
  AdminContext,
  AdminOptions,
  ApiClient,
  AppContext,
  Dialog,
  EventDispatcher,
  Flash,
  Form,
  Grid,
  I18n,
  Toolbar,
  UrlAction,
  UrlManager,
  User,
} from "~/plugins/atn/src/index";

const _ = require('lodash')

class Admin {
  // private _actionManager: ActionManager;

  private _context: AdminContext;
  private _dispatcher: EventDispatcher;
  private _user: User;
  private _namespace: string;
  private _i18n: I18n;
  private _grid: Grid;
  private _form: Form;
  private _toolbar: Toolbar;
  private _dialog: Dialog;
  private _flash: Flash;


  public constructor(namespace: string, app: AppContext, options: AdminOptions) {
    this._namespace = namespace;

    this._context = this.adminContext(app, options);
    this._dispatcher = app.dispatcher

    this._user = this.makeUser(app)
    this._dialog = new Dialog(namespace)
    this._flash = new Flash(namespace, this._context)
    this._i18n = new I18n(this._context, options.i18n)
    this._grid = new Grid(namespace, this._context, options.grid)
    this._form = new Form(namespace, this._context, options.form)
    this._toolbar = new Toolbar(namespace, this._context, options.toolbar)
  }

  private adminContext(app: AppContext, options: AdminOptions): AdminContext {
    return {
      i18n: app.i18n,
      dispatcher: app.dispatcher,
      client: new ApiClient(app, options.api),
      urlManager: new UrlManager(this._namespace, app),
      user: this._user
    }
  }

  private get dispatcher(): EventDispatcher {
    return this._dispatcher
  }

  private makeUser(app: AppContext): User {
    return {
      name: _.get(app.$auth, 'user.name'),
      email: _.get(app.$auth, 'user.email'),
      roles: _.get(app.$auth, 'user.roles'),
    };
  }

  public get namespace(): string {
    return this._namespace;
  }

  public get actionContext(): ActionContext {
    return {
      grid: this._grid,
      form: this._form,
      dialog: this._dialog,
      flash: this._flash,
      user: this._user
    };
  }

  public get urlAction(): UrlAction | undefined {
    return this._context.urlManager.urlAction
  }


  public get client(): ApiClient {
    return this._context.client;
  }

  public get i18n(): I18n {
    return this._i18n;
  }

  public get toolbar(): Toolbar {
    return this._toolbar;
  }

  public get grid(): Grid {
    return this._grid;
  }

  public get form(): Form {
    return this._form;
  }

  public get dialog(): Dialog {
    return this._dialog;
  }

  public get flash(): Flash {
    return this._flash;
  }

  // public get actionManager(): ActionManager {
  //   return this._actionManager;
  // }

}

export default Admin
