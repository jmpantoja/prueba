import {NuxtAxiosInstance} from "@nuxtjs/axios";
import {Record} from "~/plugins/admin/src/admin/index";

const _ = require('lodash')

class ApiClient {
  private _axios: NuxtAxiosInstance;
  private _endpoint: string;

  public constructor(axios: NuxtAxiosInstance) {
    this._axios = axios;
    this._endpoint = '';
  }

  public set endpoint(endpoint: string) {
    this._endpoint = endpoint;
  }

  public update(options: { item: Record, loading?: Function, then: Function }) {
    const loading = options.loading || new Function()
    const endpoint = `${this._endpoint}/${options.item.id}`

    loading(true)

    this._axios.$put(endpoint, options.item)
      .then((response) => {
        const item = _.omit(response, ['@id', '@type', '@context'])
        options.then(item)
      })
      .catch((error) => {
        console.log(error)
      })
      .finally(() => {
        loading(false)
      })

  }

  public read(options: { params: object, loading?: Function, then: Function }) {
    const loading = options.loading || new Function()
    loading(true)
    this._axios.$get(this._endpoint, {params: options.params})
      .then((response) => {
        options.then({
          total: response['hydra:totalItems'],
          items: response['hydra:member']
        })
      })
      .catch((error) => {
        console.log(error)
      })
      .finally(() => {
        loading(false)
      })
  }

  public get(options: { id: string, loading?: Function, then: Function }) {

    const loading = options.loading || new Function()
    const endpoint = `${this._endpoint}/${options.id}`
    loading(true)

    this._axios.$get(endpoint)
      .then((response) => {
        const item = _.omit(response, ['@id', '@type', '@context'])
        options.then(item)
      })
      .catch((error) => {
        console.log(error)
      })
      .finally(() => {
        loading(false)
      })
  }

}

export default ApiClient
