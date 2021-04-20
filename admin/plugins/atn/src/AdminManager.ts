import {Admin, AdminOptionsList, AppContext, EventDispatcher} from "~/plugins/atn/src/index";
import ActionManager from "~/plugins/atn/src/ActionManager";


class AdminManager {
  private _admins: AdminOptionsList;
  private _actionManager: ActionManager;
  private _context: AppContext;

  public constructor(actionManager: ActionManager, admins: AdminOptionsList, context: AppContext) {
    context.dispatcher = new EventDispatcher()
    this._actionManager = actionManager;
    this._admins = admins
    this._context = context
  }

  public byName(name: string): Admin {
    const options = this._admins[name];
    if (options) {
      const admin = new Admin(name, this._context, options)

      this._actionManager.attach(name, admin.actionContext, options.actions)
      return admin
    }

    throw new Error(`No hay ningun admin llamado "${name}"`)
  }

  public keys(): string[] {
    return Object.keys(this._admins)
  }

}

export default AdminManager;
