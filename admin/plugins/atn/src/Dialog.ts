import {DialogOptions} from "~/plugins/atn/src/index";

class Dialog {
  private _namespace: string;
  private _params: object = {};
  private _title: string = ''
  private _message: string = ''
  private _visible: boolean = false
  private _resolve: Function = (() => null)
  private _width: number = 400;

  public constructor(namespace: string) {
    this._namespace = namespace;
  }

  public get namespace(): string {
    return this._namespace;
  }

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

  public get params(): object {
    return this._params;
  }

  public confirm() {
    this._resolve()
  }

  public open(options: DialogOptions, params: object = {}) {
    this._params = params;
    this._title = options.title;
    this._message = options.message;
    this._width = options.width || this._width
    this._visible = true

    return new Promise((resolve) => {
      this._resolve = resolve
    }).then(() => {
      this._visible = false
    })
  }
}

export default Dialog;
