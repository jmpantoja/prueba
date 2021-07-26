import {ViewType} from "~/types/admin";


type RouteMeta = {
  admin: string,
  roles?: string[]
  view: ViewType
  components: { [key: string]: string },
}

export {
  RouteMeta
}
