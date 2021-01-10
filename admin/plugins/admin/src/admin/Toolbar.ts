import AdminContext from "~/plugins/admin/src/app/AdminContext";
import Crud from "~/plugins/admin/src/admin/Crud";

const _ = require('lodash')
const url = require('url')

class Toolbar {
  private _context: AdminContext;
  private _crud: Crud;


  public constructor(context: AdminContext, crud: Crud) {
    this._context = context;
    this._crud = crud
  }

  public get context(): AdminContext {
    return this._context
  }

}

export default Toolbar;
