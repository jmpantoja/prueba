import {DefaultSortOptions, Dictionary, Filter, FilterList, TableQuery} from "~/types/grid";


const _ = require("lodash")
const ORDER_PATTERN = /^order\[(.*)\]/;
const FILTER_PATTERN = /(.*)\[(.*)\]/;


function normalizeOrder(sortOptions?: DefaultSortOptions) {
  if (!sortOptions) {
    return null
  }

  let order = sortOptions.order
  let prop = sortOptions.prop

  if (!order) {
    return null
  }
  const key = `order[${prop}]`;
  const dir = order === 'ascending' ? 'asc' : 'desc';

  return {[key]: dir}
}


function normalizeFilters(filters?: FilterList) {
  if (!filters) {
    return null
  }

  const entries = Object.entries(filters)
    .map(([name, filter]) => {
      return normalizeFilter(name, filter)
    })

  return Object.fromEntries(entries)
}

function normalizeFilter(name: string, filter: Filter) {

  let key = name;
  if (filter.mode) {
    key = `${key}[${filter.mode}]`
  }
  return [key, filter.value];
}


export function normalizeQuery(query: TableQuery) {
  query.page = query.page || 0
  let page = query.page > 1 ? {page: query.page} : null
  let page_size = query.page_size ? {page_size: query.page_size} : null

  let order = normalizeOrder(query.order)
  let filters = normalizeFilters(query.filters)

  return {
    ...page,
    ...page_size,
    ...order,
    ...filters
  }
}

function denormalizePage(key: string, value: string | (string | null)[], page: number | undefined): number | undefined {
  if (key !== 'page') {
    return page
  }

  return page || (value as unknown as number) * 1
}

function denormalizePageSize(key: string, value: string | (string | null)[], page_size: number | undefined): number | undefined {
  if (key !== 'page_size') {
    return page_size
  }
  return page_size || (value as unknown as number) * 1
}

function denormalizeOrder(key: string, value: string | (string | null)[], order: DefaultSortOptions | undefined): DefaultSortOptions | undefined {

  const matches = key.match(ORDER_PATTERN)
  if (!matches) {
    return order;
  }

  return {
    prop: matches[1],
    order: value === 'desc' ? "descending" : "ascending"
  }
}

function denormalizeFilters(key: string, value: string | (string | null)[], filters: FilterList | undefined): FilterList | undefined {
  if (['page', 'page_size'].includes(key) || key.match(ORDER_PATTERN)) {
    return filters
  }

  const matches = key.match(FILTER_PATTERN)

  if (matches) {
    return {
      ...filters,
      [matches[1]]: {
        mode: matches[2],
        value
      }
    }
  }

  return {
    ...filters,
    [key]: {
      value
    }
  }
}

export function denormalizeQuery(query: Dictionary<string | (string | null)[]>): TableQuery {

  let tableQuery: TableQuery = {}

  Object.entries(query)
    .forEach(([key, value]) => {
      tableQuery.page = denormalizePage(key, value, tableQuery.page)
      tableQuery.page_size = denormalizePageSize(key, value, tableQuery.page_size)
      tableQuery.order = denormalizeOrder(key, value, tableQuery.order)
      tableQuery.filters = denormalizeFilters(key, value, tableQuery.filters)
    })


  return tableQuery
}

