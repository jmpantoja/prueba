import Vue from 'vue'
import {Action, ActionList, AdminContext} from "~/plugins/admin/src/admin/index";

class EventDispatcher {
  private _context: AdminContext;
  private _bus: Vue;

  public constructor(context: AdminContext) {
    this._bus = new Vue()
    this._context = context
  }

  public bind(context: AdminContext) {
    this._context = context
  }

  public on(event: string | string[], callback: Function): EventDispatcher {
    this._bus.$on(event, callback)
    return this;
  }

  public once(event: string | string[], callback: Function): EventDispatcher {
    this._bus.$once(event, callback)
    return this;
  }

  public off(event?: string | string[], callback?: Function): EventDispatcher {
    this._bus.$off(event, callback)
    return this;
  }

  public emit(event: string, ...args: any[]): EventDispatcher {
    this._bus.$emit(event, ...args)
    return this;
  }

  public subscribe(actions: ActionList) {
    actions.forEach((action: Action) => {
      this.on(action.name, (params: object) => {
        this.execute(action, params)
      })
    })
  }

  private execute(action: Action, params: object) {
    action.run(this._context, params)

  }
}

export default EventDispatcher;
