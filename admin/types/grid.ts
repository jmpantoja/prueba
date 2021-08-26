import {DefaultSortOptions} from "element-ui/types/table";
import {Dictionary} from "vue-router/types/router";
import {Entity} from "~/types/api";

type TableQuery = {
  page?: number,
  page_size?: number,
  order?: DefaultSortOptions,
  filters?: FilterList
}

type TableProps = {
  stripe: boolean,
  height: string,
  data: Entity[]
}

type QueryGetter = (endpoint: string) => TableQuery



type Filter = {
  mode?: string,
  value: any
}

type FilterList = { [key: string]: Filter }

export {
  DefaultSortOptions,
  Dictionary,
  TableQuery,
  TableProps,
  QueryGetter,
  Filter,
  FilterList
}


