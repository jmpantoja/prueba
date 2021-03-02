import {DataOptions, DataTableHeader} from "vuetify/types";
import {Action, ActionList, ActionOptions, defaultDataOptions, HeaderOptions} from "~/plugins/admin/src/admin";

import {GridDeleteAction, GridEditAction} from "~/plugins/admin/src/actions";

const _ = require('lodash')

class GridMapper {

  private readonly _headers: { [key: string]: DataTableHeader } = {};
  private readonly _actions: ActionList = [];
  private _itemsPerPage: number = 10;

  public constructor() {
    this.addAction(GridEditAction)
    this.addAction(GridDeleteAction)
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

  public addAction(options: ActionOptions): GridMapper {
    this._actions.push(new Action(options))

    this.addHeader('__actions', {
      text: "",
      width: '150px',
      align: 'center',
    })

    return this;
  }

  public get actions(): ActionList {
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
