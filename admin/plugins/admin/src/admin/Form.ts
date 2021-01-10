import AdminContext from "~/plugins/admin/src/app/AdminContext";
import Crud from "~/plugins/admin/src/admin/Crud";

const _ = require('lodash')
const url = require('url')

class Form {
  private _context: AdminContext;
  private _opened: boolean;
  private _loading: boolean;
  private _valid: boolean;
  private _item: object | null;
  private _crud: Crud;
  private _resolve: Function;

  public constructor(context: AdminContext, crud: Crud) {
    this._context = context;
    this._opened = false
    this._loading = false
    this._valid = false
    this._item = null
    this._crud = crud

    this._resolve = _.identity
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


  public get valid(): boolean {
    return this._valid;
  }

  public set valid(valid: boolean) {
    this._valid = valid;
  }

  public close() {
    this._opened = false
    this._item = this.default
  }

  public show(item: object | null) {
    this._valid = true
    this._opened = true
    this._item = _.cloneDeep(item)

    return new Promise((resolve) => {
      this._resolve = resolve
    })
  }

  public get title() {
    return this._context.i18n.t('hola')
  }

  public get item(): object {
    return this._item || this.default;
  }

  public get default(): object {
    return this._crud.default
  }

  public update(item: object): Promise<void | object> {
    return this._crud.update(item)
      .then((response) => {
        this._resolve(response)
        this.close()
      })

  }

  public create(item: object): Promise<void | object> {
    return this._crud.create(item)
      .then((response) => {
        this._resolve(response)
        this.close()
      })
  }

}

export default Form;
