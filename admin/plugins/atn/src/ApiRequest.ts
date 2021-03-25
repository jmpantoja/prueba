import {NuxtAxiosInstance} from "@nuxtjs/axios";
import {ApiRequestOptions, Callback, EventDispatcher, Method} from "~/plugins/atn/src/index";

const _ = require('lodash')

class ApiRequest {
  private readonly _dispatcher: EventDispatcher;
  private readonly _axios: NuxtAxiosInstance;
  private readonly _method: Method;
  private readonly _path: string;
  private readonly _params: object
  private readonly _data: object;

  private _loading: Callback = (value) => value;
  private _normalize: Callback = (value) => value;
  private _success: Callback = (value) => value;
  private _error: Callback;


  public constructor(options: ApiRequestOptions) {
    this._dispatcher = options.dispatcher;
    this._axios = options.axios;
    this._method = options.method
    this._path = options.path
    this._params = options.params || {}
    this._data = options.data || {}

    this._error = (response) => {
      const message = response.status;
      const reason = _.get(response, 'data.hydra:description', response.statusText);
      this._dispatcher.emit('flash.error', message, reason)
//      this._flash.error(message, reason)
    }
  }

  public loading(loading: Callback): ApiRequest {
    this._loading = loading;
    return this
  }

  public normalize(normalize: Callback): ApiRequest {
    this._normalize = normalize;
    return this
  }

  public success(success: Callback): ApiRequest {
    this._success = success;
    return this
  }

  public error(error: Callback): ApiRequest {
    this._error = error;
    return this
  }

  public run(then?: Callback): Promise<any> {
    return new Promise<any>((resolve, reject) => {
      this._loading(true)
      this.doRequest(resolve, reject)
    }).then(then || _.identity)
  }

  private doRequest(resolve: Function, reject: Function) {
    const request = this._axios.$request({
      method: this._method,
      url: this._path,
      params: this._params,
      data: this._data
    });

    request
      .then((response) => {
        this._loading(false)
        let data = this._normalize(response)
        this._success(data)
        resolve(data)
      }, (error) => {
        this._error(error.response)
      })
  }
}

export default ApiRequest
