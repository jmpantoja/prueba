import App from "~/plugins/admin/src/app/App";
import Crud from "~/plugins/admin/src/crud/Crud";

const _ = require('lodash')
const url = require('url')

class Toolbar {
  private _context: App;
  private _crud: Crud;


  public constructor(context: App, crud: Crud) {
    this._context = context;
    this._crud = crud
  }

  public get context(): App {
    return this._context
  }

}

export default Toolbar;
