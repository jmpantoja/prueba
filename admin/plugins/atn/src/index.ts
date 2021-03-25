import {RouteConfig} from "@nuxt/types/config/router";
import {IVueI18n} from "vue-i18n";
import {NuxtAxiosInstance} from "@nuxtjs/axios";

import Locale from "~/plugins/atn/src/Locale";
import Panel from "~/plugins/atn/src/Panel";
import FullScreen from "~/plugins/atn/src/FullScreen";

import AdminManager from "~/plugins/atn/src/AdminManager";
import Admin from "~/plugins/atn/src/Admin";
import Button from "~/plugins/atn/src/Button";
import I18n from "~/plugins/atn/src/I18n";
import Form from "~/plugins/atn/src/Form";
import FormNormalizer from "~/plugins/atn/src/FormNormalizer";
import Grid from "~/plugins/atn/src/Grid";
import DataGridRequest from "~/plugins/atn/src/DataGridRequest";
import Dialog from "~/plugins/atn/src/Dialog";
import Toolbar from "~/plugins/atn/src/Toolbar";
import Flash from "~/plugins/atn/src/Flash";

import ApiClient from "~/plugins/atn/src/ApiClient";
import ApiRequestFactory from "~/plugins/atn/src/ApiRequestFactory";
import ApiRequest from "~/plugins/atn/src/ApiRequest";
import VueRouter from "vue-router";
import UrlManager from "~/plugins/atn/src/UrlManager";


import ActionManager from "~/plugins/atn/src/ActionManager";
import EventDispatcher from "~/plugins/atn/src/EventDispatcher";
import {Auth} from "@nuxtjs/auth-next";


export type Props = { [key: string]: any }

export type MenuGroup = {
  text: string,
  icon: string,
  href: RouteConfig,
  items?: MenuGroup[]
}

export type Record = {
  id: string | number | null,
  [key: string]: any
}

export type AppContext = {
  $auth: Auth,
  i18n: IVueI18n,
  $axios: NuxtAxiosInstance,
  router: VueRouter,
  dispatcher: EventDispatcher,
}

export type AdminContext = {
  dispatcher: EventDispatcher,
  i18n: IVueI18n,
  client: ApiClient,
  urlManager: UrlManager,
  user: User
}

export type AdminOptionsList = {
  [key: string]: AdminOptions
}

export type AdminOptions = {
  roles: RolesOptions,
  i18n: I18nOptions,
  api: ApiOptions,
  toolbar: ToolbarOptions,
  grid: GridOptions,
  form: FormOptions,
  actions: ActionList
}

export type Action = {
  dialog?: DialogOptions
  roles?: string[] | ((context: ActionContext, params: any) => string[])
  disabled?: (context: ActionContext, params: any) => boolean
  run: (context: ActionContext, params: any) => void
}

export type ActionList = {
  [key: string]: Action
}

export type Customize = (props: Props, params: any) => void

export type ActionContext = {
  grid: Grid,
  form: Form,
  dialog: Dialog,
  flash: Flash,
  user: User,
}

export type ButtonOptions = {
  name?: string,
  text?: string,
  icon?: string,
  tile?: boolean,
  color?: string,
  slot?: string
  large?: boolean
  action: string,
  customize?: Customize,
}

export type ButtonOptionsList = {
  [key: string]: ButtonOptions
} | ButtonOptions[]

export type ButtonList = {
  [key: string]: Button
}


export type ApiOptions = {
  endpoint: string
}

export type RequestOptions = {
  params?: object,
  loading?: Function,
};

export type Dataset = {
  total: number,
  items: Array<Record>
}

export type I18nOptions = {
  namespace: string
}

export type GridOptions = {
  options?: GridDataOptions,
  filters?: FilterFieldList
  columns: ColumnList,
  buttons?: ButtonOptionsList
}

export type GridDataOptions = {
  itemsPerPage?: number,
  page?: number,
  sortBy?: string[],
  sortDesc?: boolean[]
}

export const defaultDataOptions = {
  groupBy: [],
  groupDesc: [],
  itemsPerPage: 10,
  multiSort: false,
  mustSort: false,
  page: 1,
  sortBy: [],
  sortDesc: []
};

export type ColumnList = { [key: string]: Column } | Column[]

export type Column = {
  key: string
  text?: string | boolean
  type?: string
  align?: 'start' | 'center' | 'end'
  sortable?: boolean
  divider?: boolean
  class?: string | string[]
  width?: string | number
}

export type FilterField = {
  key: string,
  label?: string,
  value?: any,
  type?: string,
  props?: Props
};

export type FilterFieldList = {
  [key: string]: FilterField
} | FilterField[];

export type Filter = { type: string, value: any }
export type FilterList = { [key: string]: Filter };


export type FormOptions = {
  width?: number,
  height?: number,
  groups: FormGroup[],
  default?: Record,
  buttons?: ButtonOptionsList
}

export type FormGroup = {
  label?: string,
  fields: FormField[]
}

export type FormField = {
  key: string,
  label?: string,
  type?: string,
  width?: number | string,
  props?: Props
}

export type DialogOptions = {
  title: string;
  message: string,
  width?: number
};


export type ToolbarOptions = {
  buttons?: ButtonOptionsList
}


export type Callback = ((response: any) => any)

export type Method = 'GET' | 'POST' | 'PUT' | 'DELETE'

export type ApiRequestOptions = {
  axios: NuxtAxiosInstance,
  dispatcher: EventDispatcher,
  method: Method,
  path: string,
  params?: object
  data?: object
}

export type UrlEntry = {
  name: string,
  key: string | null,
  value: any
}

export type UrlAction = {
  name: string,
  id: string | number | null
}


export type User = {
  name: string
  email: string,
  roles: string[]
}

export type RolesOptions = {
  inheritance: RoleList
}

export type  RoleList = {
  [key: string]: string[]
}

export {
  FullScreen,
  Locale,
  Panel,
  AdminManager,
  Admin,
  Button,
  ApiClient,
  ApiRequestFactory,
  ApiRequest,
  I18n,
  Form,
  FormNormalizer,
  Grid,
  DataGridRequest,
  Dialog,
  Toolbar,
  Flash,
  UrlManager,
  ActionManager,
  EventDispatcher,
}
