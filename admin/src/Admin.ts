import {ActionList, AdminConfig, AdminConfigList, AdminContext, PathList, ViewType} from "~/types/admin";
import {Entity} from "~/types/api";

const parse = require('url-parse')

class AdminManager {
  private _admins: { [name: string]: Admin };

  public constructor(config: AdminConfigList, context: AdminContext) {
    const entries = Object.entries(config)
      .map(([name, config]) => {

        return [name, new Admin(name, config, context)]
      })

    this._admins = Object.fromEntries(entries)
  }

  public byName(name: string): Admin {
    const admin = this._admins[name];

    if (!admin) {
      throw new Error(`No existe el admin '${name}'`)
    }
    return admin
  }
}


class Admin {

  private _name: string;
  private _endpoint: string
  private _view!: ViewType;
  private _paths: PathList;
  private _context: AdminContext;

  constructor(name: string, config: AdminConfig, context: AdminContext) {

    this._name = name
    this._context = context;
    this._endpoint = this.initEndpoint(config.endpoint)

    this._paths = this.initPaths(config.path, config.actions)
  }

  private initEndpoint(endpoint: string): string {
    const url = parse(this._context.api_endpoint);
    url.set('pathname', endpoint)
    return url.toString()
  }

  private initPaths(base: string, actions: ActionList) {
    const entries = Object.entries(actions)
      .map(([name, action]) => {
        return [name, `${base}${action.path}`]
      })

    return Object.fromEntries(entries)
  }

  public get endpoint(): string {
    return this._endpoint;
  }

  setView(view: ViewType): Admin {
    this._view = view
    return this
  }

  public get view(): ViewType {
    return this._view;
  }


  public get paths(): PathList {
    return this._paths
  }

  public rolesByName(...keys: (string | string[])[]): string[] {
    const roles: string[] = []

    keys
      .filter((key: string | string[]) => key)
      .forEach((key: string | string[]) => {
        const role = typeof key === "string" ? [key] : key
        roles.push(...role)
      })

    return roles
      .filter((role: string) => role.length > 0)
      .map((role: string) => {
        return `${this._name}_${role}`
      })
  }

  public pathByKey(key: string, entity?: Entity): string {
    const id = entity?.id || ''
    const path = this._paths[key]
    const localePath = this._context.localePath(path)

    return localePath.split('/')
      .map((piece: string) => {
        return piece.replace(':id', id)
      })
      .join('/')

    return path;

  }
}

export {
  Admin,
  AdminManager
};
