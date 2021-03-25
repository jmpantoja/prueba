import {
  ActionContext,
  ActionManager,
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
  UrlManager,
  User,
} from "~/plugins/atn/src/index";
import RolesManager from "~/plugins/atn/src/RolesManager";

const _ = require('lodash')

class Admin {
  private _actionManager: ActionManager;
  private _rolesManager: RolesManager;

  private _user: User;
  private _i18n: I18n;
  private _grid: Grid;
  private _form: Form;
  private _toolbar: Toolbar;
  private _dialog: Dialog;
  private _flash: Flash;


  public constructor(app: AppContext, options: AdminOptions) {

    const context = this.adminContext(app, options);

    this._user = this.makeUser(app)
    this._dialog = new Dialog()
    this._flash = new Flash(context)
    this._i18n = new I18n(context, options.i18n)
    this._grid = new Grid(context, options.grid)
    this._form = new Form(context, options.form)
    this._toolbar = new Toolbar(context, options.toolbar)
    this._rolesManager = new RolesManager(options.roles)

    this._actionManager = new ActionManager(this.actionContext, this._rolesManager)
    this._actionManager.attach(options.actions)
    this.doAction(context.urlManager);
  }

  private doAction(urlManager: UrlManager) {
    const urlAction = urlManager.dataAction;
    this._actionManager.doAction(urlAction)
  }

  private adminContext(app: AppContext, options: AdminOptions): AdminContext {
    app.dispatcher = new EventDispatcher()

    return {
      i18n: app.i18n,
      dispatcher: new EventDispatcher(),
      client: new ApiClient(app, options.api),
      urlManager: new UrlManager(app),
      user: this._user
    }
  }

  private makeUser(app: AppContext): User {
    return {
      name: _.get(app.$auth, 'user.name'),
      email: _.get(app.$auth, 'user.email'),
      roles: _.get(app.$auth, 'user.roles'),
    };
  }

  private get actionContext(): ActionContext {
    return {
      grid: this._grid,
      form: this._form,
      dialog: this._dialog,
      flash: this._flash,
      user: this._user
    };
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

  public get actionManager(): ActionManager {
    return this._actionManager;
  }

}

export default Admin
