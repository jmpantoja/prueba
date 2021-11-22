import {Message} from 'element-ui';
import {ActionList, AdminConfig, AdminConfigList, AdminContext, PathList} from "~/types/admin";
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
  private _paths: PathList;
  private _context: AdminContext;
  private _loading: boolean = false;
  private _components: { grid: string; form: string; toolbar: string };

  constructor(name: string, config: AdminConfig, context: AdminContext) {

    this._name = name
    this._context = context;
    this._endpoint = this.initEndpoint(config.endpoint)
    this._paths = this.initPaths(config.path, config.actions)
    this._components = config.components
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

  get loading(): boolean {
    return this._loading;
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

  public component(name: 'grid' | 'form' | 'toolbar'): string {
    return this._components[name];
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

  public get api(): Api {
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
    const message = this.message('flash.error', {description});

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


  public goToForm(entity: Entity) {
    const edit = this.pathByKey('edit', entity)
    this._context.router.push(edit)
  }

  public async save(entity: Entity): Promise<Entity> {
    const request = this.api.PUT(this.endpoint, entity)
    return this.apiCall(request, (response: AxiosResponse) => {
      this.success('flash.save', {entity})
      return response['data']
    })
  }

  public async create(entity: Entity): Promise<Entity> {

    const request = this.api.POST(this.endpoint, entity)
    return this.apiCall(request, (response: AxiosResponse) => {
      this.success('flash.save', {entity})
      return response['data']
    })
  }


  public async get(query: object = {}): Promise<Dataset> {

    const request = this.api.GET(this.endpoint, query)
    return this.apiCall(request, (response: AxiosResponse) => {
      const items = response.data['hydra:member']
      const totalItems = response.data['hydra:totalItems']

      return {items, totalItems}
    })
  }

  public async delete(entity: Entity): Promise<Entity> {

    const request = this.api.DELETE(this.endpoint, entity)
    return this.apiCall(request, (response: AxiosResponse) => {
      this.success('flash.delete', {entity})
      return response['data']
    })
  }

  public async findOne(id: string): Promise<Entity> {
    const endpoint = `${this.endpoint}/${id}`
    const request = this.api.GET(endpoint);

    return this.apiCall(request, (response: AxiosResponse) => {
      return response['data']
    })
  }

  private apiCall(request: AxiosPromise, then: (response: AxiosResponse) => any): Promise<any> {
    this._loading = true

    return new Promise((resolve, reject) => {
      request
        .then((response) => {
          this._loading = false

          if (response.data['@type'] === 'hydra:Error') {
            const message = response.data['hydra:description'] || 'Unknow Error'
            this.error(message)
            reject({response})
            return
          }

          resolve(then(response))
        })
        .catch((error) => {
          const message = error.response?.data['hydra:description'] || 'Not Found'
          this._loading = false
          this.error(message)
          reject(error)
        })
    })

  }
}

export {
  Admin,
  AdminManager
};
