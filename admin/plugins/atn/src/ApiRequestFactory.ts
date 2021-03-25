import {NuxtAxiosInstance} from "@nuxtjs/axios";
import {AppContext, ApiRequest, EventDispatcher} from "~/plugins/atn/src";


class ApiRequestFactory {
  private _axios: NuxtAxiosInstance;
  private _dispatcher: EventDispatcher;

  public constructor(context: AppContext) {
    this._axios = context.$axios;
    this._dispatcher = context.dispatcher;
  }

  public get(path: string, params: object = {}) {

    return new ApiRequest({
      axios: this._axios,
      dispatcher: this._dispatcher,
      method: 'GET',
      path: path,
      params: params,
    })
  }

  public put(path: string, params: object) {
    return new ApiRequest({
      axios: this._axios,
      dispatcher: this._dispatcher,
      method: 'PUT',
      path: path,
      data: params
    })
  }

  public post(path: string, params: object) {
    return new ApiRequest({
      axios: this._axios,
      dispatcher: this._dispatcher,
      method: 'POST',
      path: path,
      data: params
    })

  }

  public delete(path: string, params: object) {
    return new ApiRequest({
      axios: this._axios,
      dispatcher: this._dispatcher,
      method: 'DELETE',
      path: path,
      data: params
    })

  }

}

export default ApiRequestFactory
