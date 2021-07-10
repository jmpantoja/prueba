import {TableQuery} from "~/types";
import {DefaultSortOptions} from "element-ui/types/table";

function normalizeOrder({prop, order}: DefaultSortOptions) {
  if (!order) {
    return null
  }
  const key = `order[${prop}]`;
  const dir = order === 'ascending' ? 'asc' : 'desc';

  return {[key]: dir}
}


export function normalizeQuery(query: TableQuery) {
  query.page = query.page || 0
  let order = null
  let page = query.page > 1 ? {page: query.page} : null

  if (query.order) {
    order = normalizeOrder(query.order)
  }

  return {
    ...page,
    ...order
  }
}



