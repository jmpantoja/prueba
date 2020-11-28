import Vue from "vue"
import _ from "lodash"

class Api {
  constructor(axios) {
    this._axios = axios
    this._endpoints = {}
  }

  config(config) {
    this._endpoints = config.endpoints || {}
  }

  async execute(name, params) {
    const endpoint = this._endpoints[name]
    const method = _.toUpper(endpoint.method)
    const path = this._parse(endpoint.path, params.params || {})

    let response = {};
    switch (method) {
      case 'GET': {
        response = await this._axios.$get(path, {
          params: params.query || {}
        })
        break
      }
      case 'POST': {
        response = await this._axios.$post(path, params.data)
        break
      }
      case 'PUT': {
        response = await this._axios.$put(path, params.data)
        break
      }
      case 'DELETE': {
        response = await this._axios.$delete(path) || {success: true}
        break
      }
    }


    return response;
  }

  _parse(path, params) {
    for (var key in params) {
      let regex = new RegExp(`{${key}}`, 'g')
      path = path.replace(regex, params[key])
    }

    return path;
  }
}

class Form {
  constructor(notifier, api) {
    this._notifier = notifier
    this._api = api
    this._visible = false
    this._item = {}
  }

  config(config) {
    this._default = config.default || {}
    this._item = config.default || {}
  }

  show(item) {
    this._item = item || this._default || {}
    this._visible = true
  }

  close() {
    this._item = this._default
    this._visible = false
  }

  async update(item) {
    const response = await this._api.execute('update', {
      params: {id: item.id},
      data: item
    })

    if (response.success !== true) {
      return item
    }

    this._notifier.success('notifier.updated')

    return response.item;
  }

  async create(item) {
    const response = await this._api.execute('create', {
      data: item
    })

    if (response.success !== true) {
      return item
    }

    this._notifier.success('notifier.created')
    return response.item;
  }

  get mode() {
    return this._item.id ? 'edit' : 'create'
  }

  get item() {
    return this._item;
  }

  get opened() {
    return this._visible
  }

  set opened(value) {
    this._visible = value
  }
}

class Query {
  constructor(router) {
    this._router = router
    this._options = {}
    this._filters = {}
  }

  set options(options) {
    this._options = options
  }

  set filters(filters) {
    this._filters = filters
  }

  fromUrl(){
    console.log(this._router.currentRoute.query, 'xxx')
  }

  _parseOrder() {
    const sortBy = this._options.sortBy || {}
    const sortDesc = this._options.sortDesc || {}
    const order = {}

    sortBy.forEach(function (name, value) {
      const key = `order[${name}]`
      order[key] = sortDesc[value] ? 'desc' : 'asc'
    })

    return order
  }

  _parseFilters() {
    let filters = {}
    for (var property in this._filters) {
      filters = _.merge(filters, this._resolveFilter(property, this._filters[property]))
    }

    return filters
  }

  _resolveFilter(name, filter) {
    const resolved = {};

    if (_.has(filter, 'key') && _.has(filter, 'value')) {
      const key = `${name}[${filter.key}]`
      return this.ignoreEmpty(key, filter.value)
    }

    resolved[name] = filter.value || filter
    return resolved
  }

  ignoreEmpty(key, value) {
    const filter = {}
    if (!_.isEmpty(value)) {
      filter[key] = value
    }
    return filter
  }

  resolve() {
    const query = {
      ...this._parseOrder(),
      ...this._parseFilters(),
    }

    const name = this._router.currentRoute.name

    this._router.push({
      name: name,
      query: query
    })


    return query
  }
}

class Grid {
  constructor(notifier, query, api, form) {

    this._notifier = notifier
    this._api = api
    this._loading = false
    this._filtersPanel = false
    this._query = query;

    console.log(this._query.fromUrl())

    this._query.filters = this.defaultFilters
    this._form = form
    this._items = []
    this._total = 0
  }

  config(config) {

  }

  async load() {
    this._loading = true

    const response = await this._api.execute('list', {
      query: this._query.resolve()
    })

    this._items = response.items
    this._loading = false
    this._total = response.total
  }


  get items() {
    return this._items
  }

  get total() {
    return this._total
  }

  get loading() {
    return this._loading
  }


  get options() {
    return this._query.options
  }

  set options(options) {
    this._query.options = options;
    this.load()
  }

  filterBy(filters) {
    this._query.filters = filters;
    this.load()
  }

  get filtersPanel() {
    return this._filtersPanel
  }

  set filtersPanel(value) {
    this._filtersPanel = value
  }

  toggleFilters() {
    this._filtersPanel = !this._filtersPanel
  }

  get defaultFilters() {
    return {
      'fullName.lastName': {
        'key': 'contains',
        'value': null
      }
    }
  }

  edit(item) {
    this._form.show(item)
  }

  create() {
    this._form.show()
  }

  replace(item, replacement) {
    const index = _.findIndex(this._items, (element) => {
      return element.id === item.id
    })

    if (replacement) {
      for (var key in this._items[index]) {
        this._items[index][key] = replacement[key]
      }
      return
    }
    this._items.splice(index, 1)
  }

  async delete(item) {
    const response = await this._api.execute('delete', {
      params: {id: item.id}
    })

    if (response.success !== true) {
      return
    }

    this.replace(item, null)
    this._notifier.success('notifier.deleted')
  }
}

class Admin {
  constructor(ctx) {
    const api = this._api = new Api(ctx.$axios)
    const form = this._form = new Form(ctx.$notifier, api)
    const query = this._query = new Query(ctx.$router)
    this._grid = new Grid(ctx.$notifier, query, api, form)
  }

  config(config) {

    this.api.config(config.api || {})
    this.grid.config(config.grid || {})
    this.form.config(config.form || {})

    return this
  }

  doReactive() {
    return Vue.observable(this)
  }

  get form() {
    return this._form
  }

  get grid() {
    return this._grid
  }

  get api() {
    return this._api
  }

  get provide() {
    return {
      grid: this.grid,
      form: this.form
    }
  }
}

const makeAdmin = function (config) {
  const admin = new Admin(this)
    .config(config)
    .doReactive()
  return admin
}

export default (ctx, inject) => {
  ctx.$makeAdmin = makeAdmin
  inject('makeAdmin', makeAdmin)
}
