import AdminContext from "~/plugins/admin/src/app/AdminContext";

const _ = require('lodash')
const url = require('url')

class Panel {
  private _opened: boolean;

  public constructor(context: AdminContext) {
    this._opened = false
  }

  public get opened(): boolean {
    return this._opened;
  }

  public set opened(value: boolean) {
    this._opened = value;
  }

  public toggle() {
    this._opened = !this._opened
  }

}

export default Panel;
