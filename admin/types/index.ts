import {Security} from "~/plugins/security";
import {Api} from "~/plugins/api";

import {Context} from "@nuxt/types";
import {DefaultSortOptions} from "element-ui/types/table";

declare module '@nuxt/types' {
  interface Context {
    security: Security
    api: Api
  }

  interface NuxtAppOptions {
    security: Security,
    api: Api
  }
}

declare module 'vue/types/vue' {
  interface Vue {
    $security: Security,
    $api: Api
  }
}

type RouteMeta = {
  roles?: string[]
  endpoint: string,
  components: { [key: string]: string },
  actions: { [key: string]: string }
}

type AdminContext = {
  endpoint: string,
  actions: { [key: string]: string }
}


//GRID
type TableQuery = {
  page?: number,
  page_size?: number,
  order?: DefaultSortOptions,
  filters?: FilterList
}

type TableProps = {
  stripe: boolean,
  height: string,
  data: []
}

type QueryGetter = (endpoint: string) => TableQuery


type Filter = {
  mode?: string,
  value: any
}

type FilterList = { [key: string]: Filter }

export {
  Context,
  RouteMeta,
  AdminContext,
  TableQuery,
  TableProps,
  QueryGetter,
  Filter,
  FilterList
}



