import AdminContext from "~/plugins/admin/src/app/AdminContext";
import Crud from "~/plugins/admin/src/admin/Crud";

const _ = require('lodash')
const url = require('url')

class Dialog {
  private _context: AdminContext;
  private _opened: boolean;
  private _crud: Crud;
  private _loading: boolean;
  private _title: string;
  private _text: string;

  private _resolve: Function;

  public constructor(context: AdminContext, crud: Crud) {
    this._context = context;
    this._crud = crud
    this._opened = false
    this._loading = false
    this._resolve = _.identity
    this._title = '';
    this._text = '';
  }

  public get context(): AdminContext {
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

  public get title(): string {
    return this._title;
  }

  public get text(): string {
    return this._text;
  }

  public close() {
    this._opened = false
  }

  public ok() {
    this._resolve()
  }


  public confirm(title: string, text: string) {
    this._opened = true
    this._title = title
    this._text = text

    return new Promise((resolve) => {
      this._resolve = resolve
    })
  }

}

export default Dialog;
