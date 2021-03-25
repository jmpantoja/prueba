import {DataOptions} from "vuetify/types";
import {defaultDataOptions, Filter, FilterList} from "./index";

const _ = require('lodash')

type OrderType = { [key: string]: 'asc' | 'desc' };

class Normalizer {
  private _params: object;
  private _options: DataOptions;
  private _filters: FilterList;

  constructor(options: DataOptions, filters: FilterList) {
    this._options = _.cloneDeep(options);
    this._filters = _.cloneDeep(filters);

    this._params = {
      ...this.doOptions(),
      ...this.doFilters(),
    }
  }

  private doOptions(): object {
    return {
      page: this.page,
      page_size: this.pageSize,
      ...this.order
    }
  }

  private doFilters(): object {
    const filters = {}

    _.forOwn(this._filters, (filter: Filter, name: string) => {
      const type = filter.type
      const value = filter.value

      const key = type ? `${name}[${type}]` : name
      const item = value ? {[key]: value} : {}

      _.merge(filters, item)
    });

    return filters
  }


  private get page(): number | null {
    const page = this._options.page;

    return page !== defaultDataOptions.page ? page : null
  }

  private get pageSize(): number | null {
    const pageSize = this._options.itemsPerPage;
    return pageSize !== defaultDataOptions.itemsPerPage ? pageSize : null
  }

  private get order(): OrderType | null {
    const name = this._options.sortBy.shift()

    if (!name) {
      return null
    }

    const dir = this._options.sortDesc.shift() ? 'desc' : 'asc'
    const key = `order[${name}]`

    return {
      [key]: dir
    }
  }

  public params(): object {
    return _.pickBy(this._params, _.identity)
  }
}


class DataGridRequest {
  static normalize(options: DataOptions, filters: FilterList): object {
    return new Normalizer(options, filters).params()
  }
}

export default DataGridRequest
