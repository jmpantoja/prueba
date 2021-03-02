import App from "~/plugins/admin/src/app/App";
import Crud from "~/plugins/admin/src/crud/Crud";
import Item from "~/plugins/admin/src/crud/Item";

const _ = require('lodash')
const url = require('url')

abstract class Dialog {
  protected _context: App;
  protected _crud: Crud;

  private _opened: boolean;
  private _loading: boolean;
  private _resolve: Function;

  public constructor(context: App, crud: Crud) {
    this._context = context;
    this._crud = crud
    this._opened = false
    this._loading = false
    this._resolve = _.identity
  }

  public abstract get actionName(): string

  public get context(): App {
    return this._context
  }

  public get opened(): boolean {
    return this._opened;
  }

  public set opened(value: boolean) {
    this._opened = value;
  }

  public get loading(): boolean {
    return this._loading;
  }

  public set loading(value: boolean) {
    this._loading = value;
  }

  public close() {
    this._opened = false
    this.loading = false
    this._context.url.removeAction(this.actionName)
  }

  public ok(item: object | null) {
    this._resolve(item)
  }

  public show(item: Item | null): Promise<any> {
    this._opened = true
    this._context.url.addAction(this.actionName, item)

    const promise = new Promise((resolve) => {
      this._resolve = resolve
    })
      .then((response) => {
        this._loading = true
        return response
      })

    return promise
  }
}

export default Dialog;
