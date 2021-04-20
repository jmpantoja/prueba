import {ActionContext, ActionList, RolesManager, UrlAction} from "~/plugins/atn/src";
import Button from "~/plugins/atn/src/Button";

type ContextList = { [key: string]: ActionContext }
type ActionListList = { [key: string]: ActionList }


class ActionManager {
  private _security: RolesManager;
  private _actions: ActionListList = {};
  private _contexts: ContextList = {}

  public constructor(security: RolesManager) {
    this._security = security;

  }

  public attach(namespace: string, context: ActionContext, actions: ActionList) {
    this._contexts[namespace] = context;

    Object.entries(actions)
      .forEach(([key, action]) => {
        this._actions[namespace] = this._actions[namespace] || {}

        this._actions[namespace][key] = action
      })
  }

  public run(namespace: string, name: string, params: object) {

    const context = this._contexts[namespace]
    const action = this.actionByName(namespace, name);
    if (!action.dialog) {
      action.run(context, params)
      return
    }
    const values = context.toString()
    context.dialog
      .open(action.dialog, params)
      .then(() => {
        action.run(context, params)
      })
  }

  public isGranted(button: Button, params: object) {
    const action = this.actionFromButton(button);
    if (!action.roles) {
      return true
    }
    const namespace = button.namespace
    const context = this._contexts[namespace]

    const roles = typeof action.roles === 'function' ?
      action.roles(context, params) :
      action.roles

    return this._security.isGranted(roles, context.user)
  }

  public disabled(button: Button, params: object) {
    const action = this.actionFromButton(button);
    if (!action.disabled) {
      return false
    }

    const namespace = button.namespace
    const context = this._contexts[namespace]

    return action.disabled(context, params)
  }

  private actionFromButton(button: Button) {
    const namespace = button.namespace
    const name = button.action

    return this.actionByName(namespace, name)
  }

  private actionByName(namespace: string, name: string) {
    const action = this._actions[namespace][name]
    if (!action) {
      throw new Error(`La accción "${namespace}.${name}" no existe`)
    }
    return action
  }

  public doAction(action?: UrlAction) {
    if (!action) {
      return
    }
    this.run(action.namespace, action.name, {item: {id: action.id}})
  }
}

export default ActionManager
