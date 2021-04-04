import {Admin, AdminOptionsList, AppContext} from "~/plugins/atn/src/index";
import ApiClient from "~/plugins/atn/src/ApiClient";


class ClientManager {
  private _admins: AdminOptionsList;
  private _context: AppContext;

  public constructor(admins: AdminOptionsList, context: AppContext) {
    this._admins = admins
    this._context = context
  }

  public get(name: string): ApiClient {
    if (this._admins[name]) {
      const options = this._admins[name];
      return new ApiClient(this._context, options.api)
    }

    throw new Error(`No hay ningun admin llamado "${name}"`)
  }

  public keys(): string[] {
    return Object.keys(this._admins)
  }

}

export default ClientManager;
