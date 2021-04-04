import {Admin, AdminOptionsList, AppContext} from "~/plugins/atn/src/index";


class AdminManager {
  private _admins: AdminOptionsList;
  private _context: AppContext;

  public constructor(admins: AdminOptionsList, context: AppContext) {
    this._admins = admins
    this._context = context
  }

  public byName(name: string): Admin {
    if (this._admins[name]) {

      return new Admin(this._context, this._admins[name])
    }

    throw new Error(`No hay ningun admin llamado "${name}"`)
  }

  public keys(): string[] {
    return Object.keys(this._admins)
  }

}

export default AdminManager;
