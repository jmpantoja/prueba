import {Filter, FilterList, TableQuery} from "~/types";
import {DefaultSortOptions} from "element-ui/types/table";

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

  console.log(entries)

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

  let order = normalizeOrder(query.order)
  let filters = normalizeFilters(query.filters)

  return {
    ...page,
    ...order,
    ...filters
  }
}



