import {NuxtAxiosInstance} from "@nuxtjs/axios";
import {Dataset, EventDispatcher, Record} from "~/plugins/admin/src/admin/index";

const _ = require('lodash')

type ApiCallOptions = {
  params?: object,
  loading?: Function,
  then: Function,
};

class ApiClient {
  private _axios: NuxtAxiosInstance;
  private _endpoint: string;
  private _dispatcher: EventDispatcher

  public constructor(axios: NuxtAxiosInstance, dispatcher: EventDispatcher) {
    this._axios = axios;
    this._dispatcher = dispatcher
    this._endpoint = '';
  }

  public set endpoint(endpoint: string) {
    this._endpoint = endpoint;
  }

  public remove(item: Record, options: ApiCallOptions): Promise<any> {
    return this.delete(`#/${item.id}`, {
      ...options,
      then: (response: object) => {
        return options.then(response)
      }
    })
  }

  public update(item: Record, options: ApiCallOptions): Promise<Record> {
    return this.put(`#/${item.id}`, {
      ...options,
      params: item,
      then: (response: object) => {
        const item = _.omit(response, ['@id', '@type', '@context'])
        return options.then(item)
      }
    })
  }

  public read(options: ApiCallOptions): Promise<Dataset> {
    return this.get('#', {
      ...options,
      then: (response: { 'hydra:totalItems': any, 'hydra:member': any }) => {
        return options.then({
          total: response['hydra:totalItems'],
          items: response['hydra:member']
        })
      }
    })
  }

  public findOne(id: string, options: ApiCallOptions): Promise<Record> {
    return this.get(`#/${id}`, {
      ...options,
      then: (response: object) => {
        const item = _.omit(response, ['@id', '@context', '@type'])
        return options.then(item)
      }
    })
  }

  public get(path: string, options: ApiCallOptions): Promise<any> {
    const endpoint = path.replace('#', this._endpoint)
    const callback = this._axios.$get(endpoint, {
      params: options.params
    })

    return this.exec(callback, options)
  }

  public put(path: string, options: ApiCallOptions): Promise<any> {
    const endpoint = path.replace('#', this._endpoint)
    const callback = this._axios.$put(endpoint, options.params)

    return this.exec(callback, options)
  }

  public delete(path: string, options: ApiCallOptions): Promise<any> {
    const endpoint = path.replace('#', this._endpoint)
    const callback = this._axios.$delete(endpoint, options.params)

    return this.exec(callback, options)
  }

  private exec(promise: Promise<any>, options: ApiCallOptions): Promise<any> {
    const loading = options.loading || new Function()
    loading(true)

    return promise
      .then((response) => {
        return options.then(response)
      })
      .catch((error) => {
        const response = error.response.data
        throw new Error(response['hydra:description'])
      })
      .finally(() => {
        loading(false)
      })
  }


}

export default ApiClient
