import {Context} from "@nuxt/types";
import {NuxtAxiosInstance} from "@nuxtjs/axios";
import {AxiosPromise} from "axios";

class Api {
  private _context: Context;

  public constructor(context: Context) {
    this._context = context;

  }

  public get axios(): NuxtAxiosInstance {
    return this._context.$axios
  }

  public GET(url: string, query: object = {}): AxiosPromise {

    return this.axios.get(url, {
      params: query
    })
  }
}

export {Api}

export default (context: Context, inject: Function) => {

  const api = new Api(context);

  context.api = api
  inject('api', api)

}
