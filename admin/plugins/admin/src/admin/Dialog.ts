import {DialogOptions} from "~/plugins/admin/src/admin/index";

const _ = require('lodash')

class Dialog {
  private _title: string = ''
  private _message: string = ''
  private _visible: boolean = false
  private _resolve: Function = _.identity
  private _width: number = 350;

  public set visible(value: boolean) {
    this._visible = value;
  }

  public get visible(): boolean {
    return this._visible;
  }

  public get title(): string {
    return this._title;
  }

  public get message(): string {
    return this._message;
  }

  public get width(): number {
    return this._width;
  }

  public confirm() {
    this._resolve()
  }

  public open(options: DialogOptions) {
    this._title = options.title;
    this._message = options.message;
    this._width = options.width || 350
    this._visible = true

    return new Promise((resolve) => {
      this._resolve = resolve
    })
      .then(() => {
        this._visible = false
      })

  }
}

export default Dialog;
