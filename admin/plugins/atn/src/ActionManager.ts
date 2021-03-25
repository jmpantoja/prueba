import {ActionContext, ActionList, UrlAction} from "~/plugins/atn/src";
import RolesManager from "~/plugins/atn/src/RolesManager";

class ActionManager {
  private _context: ActionContext;
  private _rolesManager: RolesManager;
  private _actions: ActionList = {};

  public constructor(context: ActionContext, rolesManager: RolesManager) {
    this._context = context;
    this._rolesManager = rolesManager;

  }

  public attach(actions: ActionList) {
    this._actions = actions
  }

  public run(name: string, params: object) {
    const action = this.actionByName(name);
    if (!action.dialog) {
      action.run(this._context, params)
      return
    }

    this._context.dialog
      .open(action.dialog)
      .then(() => {
        action.run(this._context, params)
      })
  }

  public granted(name: string, params: object) {
    const action = this.actionByName(name);
    if (!action.roles) {
      return true
    }

    const roles = typeof action.roles === 'function' ?
      action.roles(this._context, params) :
      action.roles

    return this._rolesManager.isGranted(roles, this._context.user)
  }

  public disabled(name: string, params: object) {
    const action = this.actionByName(name);
    if (!action.disabled) {
      return false
    }

    return action.disabled(this._context, params)
  }

  private actionByName(name: string) {
    const action = this._actions[name]
    if (!action) {
      throw new Error(`La accción "${name}" no existe`)
    }
    return action
  }

  public doAction(action?: UrlAction) {
    if (!action) {
      return
    }
    this.run(action.name, {item: {id: action.id}})
  }
}

export default ActionManager
