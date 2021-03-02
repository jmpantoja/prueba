import Crud from "~/plugins/admin/src/crud/Crud";
import {AdminContext, AdminUrl} from "../../types";
import {DataOptions} from 'vuetify/types'
import Item from "~/plugins/admin/src/crud/Item";

const _ = require('lodash')


class Grid {
  private _crud: Crud;
  private _context: AdminContext;
  private _url: AdminUrl;

  private _headers: object[];
  private _actions: object[];
  private _toolbar: object[];
  private _items: object[];
  private _loading: boolean;
  private _total: number;
  private _options: DataOptions;
  private _filters: object;

  public constructor(context: AdminContext, crud: Crud) {
    this._context = context
    this._crud = crud
    this._headers = []
    this._actions = []
    this._toolbar = []
    this._items = []
    this._loading = false
    this._total = 0
    this._url = context.url
    this._options = context.url.options()
    this._filters = context.url.filters()
  }

  public get context(): AdminContext {
    return this._context
  }

  public initialize(headers: object[], actions: object) {
    this.initActions(actions)
    this.initHeaders(headers)
    this.initToolbar(actions)
    this.initDialog()
  }


  private initDialog() {
    const actionId = this._context.url.getActionId()
    if (!actionId) {
      return
    }

    this.showDialog(actionId.action, actionId.id)
  }

  public showDialog(action: string, id: string) {
    switch (action) {
      case 'edit': {
        this._crud.findById(id)
          .then((item) => {
            this.save(item)
          })
          .catch((reason) => {
            this.showError(reason)
          })
        break
      }
      case 'create': {
        this.save()
        break
      }

      case 'delete': {
        this.confirmDelete({id})
        break
      }
    }
  }


  private initHeaders(headers: object[]) {
    let extraHeader = {}
    const length = Object.keys(this._actions).length

    if (length > 0) {
      extraHeader = {value: '__actions', sortable: false, width: 200, align: 'right'}
    }

    this._headers = _.chain(headers)
      .keyBy('value')
      .merge({
        __actions: extraHeader
      })
      .values()
      .value()
  }

  private initActions(actions: object) {
    const defaultActions = {
      edit: {
        icon: 'mdi-pencil',
        action: 'save'
      },
      delete: {
        icon: 'mdi-delete',
        action: 'confirmDelete'
      }
    }

    this._actions = _.chain(defaultActions)
      .merge(actions)
      .values()
      .compact()
      .pickBy(_.identity)
      .value();
  }

  private initToolbar(toolbar: object) {
    const defaultToolbar = {
      create: {
        icon: 'mdi-plus',
        action: 'save'
      },
      export: {
        icon: 'mdi-download',
        action: 'export',
        items: [
          {
            title: 'xls',
            icon: 'mdi-file-excel-outline'
          },
          {
            title: 'json',
            icon: 'mdi-code-json'
          }
        ]
      }
    }

    this._toolbar = _.chain(defaultToolbar)
      .merge(toolbar)
      .values()
      .reverse()
      .compact()
      .pickBy(_.identity)
      .value();
  }

  private showError(reason: any) {
    const response = reason.response
    var message = _.get(response, "data['hydra:description']", response.statusText)
    this._crud.toast.error(message)
  }


  public get headers(): object[] {
    return this._headers
  }

  public get actions(): object[] {
    return this._actions
  }

  public get toolbar(): object[] {
    return this._toolbar
  }


  public get items(): object[] {
    return this._items
  }

  public get loading() {
    return this._loading
  }

  public get total(): number {
    return this._total
  }

  public get options(): DataOptions {
    return this._options
  }

  public set options(options) {
    this._options = options
    this.reload()
  }

  public get page(): number {
    return this._options.page
  }

  public set page(page) {
    if (this._options.page !== page) {
      this._options.page = page
      this.reload()
    }
  }

  public reload() {
    if (this._loading) {
      return
    }

    this._loading = true
    const query = this._url.parse(this._options, this._filters)

    this._crud.read(query)
      .then((response) => {
        this._items = _.get(response, 'hydra:member')
        this._total = _.get(response, 'hydra:totalItems')
        this._loading = false
        this._url.goTo(query)
      })
      .catch((reason) => {
        this.showError(reason)
      })
  }


  public filterBy(filters: object) {
    this._filters = filters
    this._options = this._url.defaultOptions
    this.reload()
  }

  public export(format: { title: string }) {
    alert('export: ' + format.title)
  }

  public save(item?: Item) {

    if (!item) {
      item = this._crud.default
    }

    this._crud.form.show(item)
      .then(async (data) => {

        const id = _.get(data, 'id');
        if (id) {
          // @ts-ignore
          return await this.edit(item, data);
        }
        return await this.create(data);

      })
      .then(() => {
        this._crud.form.close()
      })
  }

  private async create(data: Item) {
    return await this._crud.create(data)
      .then((response) => {
        this._crud.toast.success('dialog.create.success')
        this.reload()
      })
      .catch((reason) => {
        this.showError(reason)
      })
  }

  private async edit(item: Item, data: Item) {
    return await this._crud.update(data)
      .then((response) => {
        this._crud.toast.success('dialog.edit.success')
        this.reload()
      })
      .catch((reason) => {
        this.showError(reason)
      })
  }

  public confirmDelete(item: Item) {

    this._crud.deleteDialog.show(item)
      .then(async () => {
        await this.delete(item);
      })
      .then(() => {
        this._crud.deleteDialog.close()
      })
  }

  private async delete(item: Item) {
    await this._crud.delete(item)
      .then(() => {
        this._crud.toast.success('dialog.delete.success')
        this.reload()
      })
      .catch((reason) => {
        this.showError(reason)
      })
  }
}

export default Grid;
