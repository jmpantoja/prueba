import {Admin, AdminManager} from '~/src/Admin'
import {NuxtI18nInstance} from "nuxt-i18n";
import {Api} from "~/src/Api";
import VueRouter, {Route} from 'vue-router'


enum ViewType {
  'list' = 'list',
  'edit' = 'edit',
  'create' = 'create',
  'delete' = 'delete'
};

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
  [key in ViewType]: ActionConfig
};


type AdminConfig = {
  path: string,
  endpoint: string,
  components: {
    list: string,
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
  ViewType,
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
