import App from "~/plugins/admin/src/app/App";
import Crud from "~/plugins/admin/src/crud/Crud";

declare module '@nuxt/types' {
  interface Context {
    $toast: Toast
  }
}

class Toast {
  private _context: App;
  private _crud: Crud;
  private _opened: boolean
  private _title: string;
  private _message: string;
  private _color: string;


  public constructor(context: App, crud: Crud) {
    this._context = context;
    this._crud = crud
    this._opened = false
    this._title = ''
    this._message = ''
    this._color = '#F00';
  }

  public get context(): App {
    return this._context
  }

  public get opened() {
    return this._opened
  }

  public set opened(opened: boolean) {
    this._opened = opened
  }

  public get message(): string {
    return this._message;
  }

  public get title(): string {
    return this._title;
  }

  public get color(): string {
    return this._color;
  }

  public success(message: string) {
    this._opened = true
    this._title = 'OK'
    this._message = message
    this._color = 'success'
  }
  public error(message: string) {
    this._opened = true
    this._title = 'Error'
    this._message = message
    this._color = 'error'
  }
}

export default Toast;
