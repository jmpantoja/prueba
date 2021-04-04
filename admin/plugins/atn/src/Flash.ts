import {AdminContext, EventDispatcher} from "~/plugins/atn/src/index";


class Flash {
  private _message: string = ''
  private _visible: boolean = false
  private _color: string = 'success';
  private _reason?: string;
  private _timeout: number = 2000;
  private _isError: boolean = false;
  private _dispatcher: EventDispatcher;

  public constructor(context: AdminContext) {
    this._dispatcher = context.dispatcher

    this._dispatcher.on('flash.error', (message: string, reason: string) => {
      this.error(message, reason)
    })
  }

  public set visible(value: boolean) {
    this._visible = value;
  }

  public get visible(): boolean {
    return this._visible;
  }

  public get message(): string {
    return this._message;
  }

  public get reason(): string | undefined {
    return this._reason;
  }

  public get color(): string {
    return this._color;
  }

  public get timeout(): number {
    return this._timeout
  }

  public get isError(): boolean {
    return this._isError
  }

  public success(message: string) {
    this._isError = false
    this._timeout = 2000
    this._message = `flash.success.${message}`;
    this._color = 'success'
    this._reason = '';
    this._visible = true
  }

  public error(message: string, reason: string) {
    this._isError = true
    this._timeout = -1
    this._message = `flash.error.${message}`;
    this._reason = reason.replace('\n', '<br/>' );
    this._color = 'error'
    this._visible = true
  }
}

export default Flash;
