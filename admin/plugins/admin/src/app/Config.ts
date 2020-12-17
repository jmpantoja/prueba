import {RouteConfig} from "@nuxt/types/config/router";

type MenuGroup = {
  text: string,
  icon: string,
  href: RouteConfig,
  items?: MenuGroup[]
}

type Config = {
  menu: MenuGroup[]
}

export default Config;

export {
  MenuGroup
}
