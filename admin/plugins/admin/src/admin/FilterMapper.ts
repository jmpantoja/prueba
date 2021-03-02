import {FilterField, FilterOptions} from ".";
const _ = require("lodash")


class FilterMapper {
  private _filters: Array<FilterField> = []

  addFilter(name: string, options: FilterOptions): FilterMapper {
    const commons = {
      label: options.label,
      type: options.type || 'filter-text',
      value: options.value || '',
    }

    const props = _.omit(options, ['type', 'label', 'value'])
    const filter = {
      name,
      ...commons,
      props
    }

    this._filters.push(filter)
    return this
  }

  public get fields(): Array<FilterField> {
    return this._filters;
  }

  public get default(): object {
    return _.mapValues(this._filters, (filter: FilterField) => {
      return filter.value
    })
  }
}

export default FilterMapper;
