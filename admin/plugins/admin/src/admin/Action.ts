import {ActionOptions, AdminContext, DialogOptions, FlashMessage} from "~/plugins/admin/src/admin/index";

const _ = require('lodash')

class Action {
  private readonly _name: string;
  private readonly _icon?: string;
  private readonly _label?: string;
  private readonly _dialog?: DialogOptions;
  private readonly _message: FlashMessage;
  private readonly _props: object;
  private readonly _callback: (context: AdminContext, params: object) => Promise<any>;
  private readonly _enabled?: (context: AdminContext) => void;


  public constructor(options: ActionOptions) {
    this._name = options.name
    this._icon = options.icon
    this._label = options.label
    this._dialog = options.dialog
    this._message = options.message || {}
    this._callback = options.exec
    this._enabled = options.enabled
    this._props = _.omit(options, ['name', 'icon', 'label', 'exec', 'enabled', 'dialog', 'message'])
  }

  public get name(): string {
    return this._name;
  }

  public get icon(): string | undefined {
    return this._icon;
  }

  public get label(): string | undefined {
    return this._label;
  }

  public get props(): object {
    return this._props;
  }

  public get enabled(): (context: AdminContext, params?: object) => void {
    const trusty = () => {
      return true
    }
    return this._enabled || trusty
  }

  public run(context: AdminContext, params: object) {

    if (this._dialog) {
      context.dialog
        .open(this._dialog)
        .then(() => {
          this.execute(context, params)
        })
      return;
    }

    this.execute(context, params);
  }

  private execute(context: AdminContext, params: object) {
    const promise = this._callback(context, params)
    if (!promise) {
      return
    }

    promise
      .then(() => {
        if (this._message.success) {
          context.flash.success(this._message.success)
        }
      })
      .catch((error: Error) => {
        if (this._message.failure) {
          context.flash.error(this._message.failure, error.message)
        }
      })
  }
}

export default Action

