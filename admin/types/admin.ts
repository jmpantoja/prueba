import {Admin, AdminManager} from '~/src/Admin'
import {NuxtI18nInstance} from "nuxt-i18n";
import {Api} from "~/src/Api";
import VueRouter, {Route} from 'vue-router'

type AdminContext = {
  api_endpoint: string,
  localePath: Function,
  i18n: NuxtI18nInstance,
  api: Api,
  router: VueRouter,
  from: () => Route
}

type ActionConfig = {
  component: string,
  path: string,
};

type ActionList = {
  [key:string]: ActionConfig
};


type AdminConfig = {
  path: string,
  endpoint: string,
  components: {
    grid: string,
    form: string,
    toolbar: string,
  },
  actions: ActionList
}

type AdminConfigList = {
  [name: string]: AdminConfig
}

type PathList = { [p: string]: string };
type RoleList = { [p: string]: string };

export {
  PathList,
  RoleList,
  AdminContext,
  ActionConfig,
  ActionList,
  AdminConfig,
  AdminConfigList,
  Admin,
  AdminManager
}
