import {Admin, AdminManager} from '~/src/Admin'


enum ViewType {
  'list' = 'list',
  'edit' = 'edit',
  'create' = 'create',
  'delete' = 'delete'
};

type AdminContext = {
  api_endpoint: string,
  localePath: Function,
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
