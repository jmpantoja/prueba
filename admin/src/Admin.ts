import {Message} from 'element-ui';
import {ActionList, AdminConfig, AdminConfigList, AdminContext, PathList, ViewType} from "~/types/admin";
import {Api, Dataset, Entity} from "~/types/api";
import {AxiosPromise, AxiosResponse} from "axios";

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
  private _loading: boolean = false;

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

  public setView(view: ViewType): Admin {
    this._view = view
    return this
  }


  public get endpoint(): string {
    return this._endpoint;
  }

  get loading(): boolean {
    return this._loading;
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
  }

  public message(key: string, params: object = {}): string {
    const path = `admin.${this._name}.${key}`;
    return this._context.i18n.t(path, params).toString()
  }

  private get api(): Api {
    return this._context.api
  }

  public success(key: string, params: object = {}) {
    const message = this.message(key, params);
    Message({
      dangerouslyUseHTMLString: true,
      showClose: true,
      message: message as string,
      type: 'success'
    });
  }

  public error(description: string) {
    const message = this.message('message.error', {description});

    Message({
      dangerouslyUseHTMLString: true,
      showClose: true,
      message: message,
      type: 'error'
    });
  }

  public goToList() {
    const previous = this._context.from()
    const list = this.pathByKey('list')

    if (previous.path !== list) {
      this._context.router.push(list)
      return
    }

    this._context.router.push(previous.fullPath)
  }

  public async save(entity: Entity): Promise<Entity> {
    const request = this.api.PUT(this.endpoint, entity)
    return this.request(request, (response: AxiosResponse) => {
      this.success('message.save', {entity})
      return response['data']
    })
  }

  public async create(entity: Entity): Promise<Entity> {

    const request = this.api.POST(this.endpoint, entity)
    return this.request(request, (response: AxiosResponse) => {
      this.success('message.save', {entity})
      return response['data']
    })
  }


  public async get(query: object): Promise<Dataset> {

    const request = this.api.GET(this.endpoint, query)
    return this.request(request, (response: AxiosResponse) => {
      const items = response.data['hydra:member']
      const totalItems = response.data['hydra:totalItems']
      return {items, totalItems}
    })
  }

  public async delete(entity: Entity): Promise<Entity> {

    const request = this.api.DELETE(this.endpoint, entity)
    return this.request(request, (response: AxiosResponse) => {
      this.success('message.delete', {entity})
      return response['data']
    })
  }

  public async findOne(id: string): Promise<Entity> {
    const endpoint = `${this.endpoint}/${id}`
    const request = this.api.GET(endpoint);
    return this.request(request, (response: AxiosResponse) => {
      return response['data']
    })
  }

  private request(request: AxiosPromise, then: (response: AxiosResponse) => any): Promise<any> {
    this._loading = true

    return new Promise((resolve, reject) => {
      request
        .then(then)
        .then((response) => {
          this._loading = false
          resolve(response)
        })
        .catch((error) => {
          const message = error.response?.data['hydra:description'] || 'Not Found'
          this._loading = false
          this.error(message)
          reject(message)
        })
    })

  }
}

export {
  Admin,
  AdminManager
};
