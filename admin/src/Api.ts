import {Context} from "@nuxt/types";
import {NuxtAxiosInstance} from "@nuxtjs/axios";
import {AxiosPromise} from "axios";
import {Entity} from "~/types/api";

class Api {
  private _context: Context;

  public constructor(context: Context) {
    this._context = context;

  }

  public get axios(): NuxtAxiosInstance {
    return this._context.$axios
  }

  public GET(endpoint: string, query: object = {}, config = {}): AxiosPromise {
    return this.axios.get(endpoint, {
      ...config,
      params: query,
    })
  }

  public PUT(endpoint: string, entity: Entity): AxiosPromise {
    const url = `${endpoint}/${entity.id}`

    return this.axios.put(url, entity)
  }

  public POST(endpoint: string, entity: Entity): AxiosPromise {
    return this.axios.post(endpoint, entity)
  }

  public DELETE(endpoint: string, entity: Entity): AxiosPromise {
    const url = `${endpoint}/${entity.id}`
    return this.axios.delete(url)
  }

}

export {
  Api
}
