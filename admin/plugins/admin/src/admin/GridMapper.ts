import {DataOptions, DataTableHeader} from "vuetify/types";
import {defaultDataOptions, HeaderOptions, ItemAction, ItemActionList} from "~/plugins/admin/src/admin";

const _ = require('lodash')


class GridMapper {

  private readonly _headers: { [key: string]: DataTableHeader } = {};
  private readonly _actions: ItemActionList = {};
  private _extra: { [key: string]: DataTableHeader } = {};
  private _itemsPerPage: number = 10;

  public constructor() {
    this.addAction('onEdit', {
      icon: 'mdi-pencil',
    })
  }

  public setItemsPerPage(value: number): GridMapper {
    this._itemsPerPage = value
    return this
  }


  public addHeader(value: string, options?: HeaderOptions | string): GridMapper {
    if (typeof options === 'string') {
      options = {text: options}
    }

    const defaults = {sortable: false, text: value};
    const header = _.defaults({value}, options, defaults)

    this._headers[value] = header
    return this
  }


  public get headers(): Array<DataTableHeader> {
    return _(this._headers)
      .sortBy((header: DataTableHeader) => {
        return header.value === '__actions'
      })
      .value()
  }

  public addAction(name: string, action: ItemAction): GridMapper {
    this._actions[name] = action

    this.addHeader('__actions', {
      text: "",
      width: '150px',
      align: 'center',
    })

    return this;
  }

  public get actions(): ItemActionList {
    return this._actions;
  }

  public get options(): DataOptions {
    return {
      ...defaultDataOptions,
      itemsPerPage: this._itemsPerPage
    }
  }

}

export default GridMapper
