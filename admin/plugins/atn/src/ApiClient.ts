import {ApiOptions, ApiRequest, ApiRequestFactory, AppContext, Record} from "~/plugins/atn/src";

const _ = require('lodash')


class ApiClient {
  private _endpoint: string;
  private _factory: ApiRequestFactory;

  constructor(context: AppContext, options: ApiOptions) {
    this._endpoint = options.endpoint
    this._factory = new ApiRequestFactory(context)
  }

  public create(item: Record): ApiRequest {
    const path = `${this._endpoint}`;
    return this._factory
      .post(path, item)
      .normalize((response) => {
        return _.omit(response, ['@context', '@id', '@type'])
      })
  }


  public read(params: object): ApiRequest {
    return this._factory
      .get(this._endpoint, params)
      .normalize((response) => {
        return {
          total: response['hydra:totalItems'],
          items: response['hydra:member']
        }
      })
  }

  public update(item: Record): ApiRequest {
    const path = `${this._endpoint}/${item.id}`;

    return this._factory
      .put(path, item)
      .normalize((response) => {
        return _.omit(response, ['@context', '@id', '@type'])
      })
  }


  public delete(item: Record): ApiRequest {
    const path = `${this._endpoint}/${item.id}`;
    return this._factory
      .delete(path)
  }

  public item(id: string | number) {

    const path = `${this._endpoint}/${id}`;
    return this._factory
      .get(path)
      .normalize((response) => {
        return _.omit(response, ['@context', '@id', '@type'])
      })
  }


  public get endpoint(): string {
    return this._endpoint;
  }
}

export default ApiClient
