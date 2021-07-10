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
  components: { [key: string]: string }
}


//GRID
type TableQuery = {
  page?: number,
  order?: DefaultSortOptions,
  filters?: FilterList
}

type TableProps = {
  stripe: boolean,
  height: string,
  data: []
}

type Filter = {
  mode?: string,
  value: any
}

type FilterList = { [key: string]: Filter }

export {
  Context,
  RouteMeta,
  TableQuery,
  TableProps,
  Filter,
  FilterList
}



