import Admin from "./Admin";
import Action from "./Action";
import ApiClient from "./ApiClient";
import ApiRequest from "./ApiRequest";
import Dialog from "./Dialog";
import Flash from "./Flash";
import FilterMapper from "./FilterMapper";
import Grid from "./Grid";
import GridMapper from "./GridMapper";
import FormMapper from "./FormMapper";
import Form from "./Form";
import Toolbar from "./Toolbar";
import ToolbarMapper from "./ToolbarMapper";
import EventDispatcher from "~/plugins/admin/src/admin/EventDispatcher";

export interface Record {
  id: string | number | null,

  [key: string]: any
}

export type Dataset = {
  total: number,
  items: Array<Record>
}

export type HeaderOptions = {
  text?: string,
  align?: 'left' | 'center' | 'right',
  sortable?: boolean,
  divider?: boolean,
  class?: string | string[],
  cellClass?: string | string[],
  width?: string | number,
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

export type Filter = {
  type: string,
  value: any
}

export type FilterList = { [key: string]: Filter };

export type FilterOptions = {
  type?: string,
  label: string,
  value?: any,
  [key: string]: any
};

export type FilterField = {
  type: string,
  label: string,
  value: any,
}

export type ActionList = Array<Action>

export type ActionOptions = {
  name: string;
  icon?: string;
  label?: string
  dialog?: DialogOptions,
  message?: FlashMessage,
  [key: string]: any
  exec(context: AdminContext, params: object): Promise<any>
  enabled?(context: AdminContext, params?: object): void
}

export type AdminContext = {
  client: ApiClient
  grid: Grid,
  form: Form,
  dialog: Dialog,
  flash: Flash,
  toString: (item: Record) => string
}

export type DialogOptions = { title: string; message: string, width?: number };

export type FlashMessage = { success?: string, failure?: string };

export type FormLayout = { rows: Array<FormRow>; tabs: Array<FormTab> };

export type FormTab = {
  label: string,
  rows: Array<FormRow>
}

export type FormRow = Array<FormColumn>

export type FormColumn = {
  fields: FormFieldList,
  props: object,
}

export type FormField = {
  label: string;
  type: object | string;
}

export type FormFieldList = { [key: string]: FormField }

export type ColNumber = 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 | 11 | 12


export {
  Admin,
  Action,
  ApiClient,
  ApiRequest,
  Dialog,
  Flash,
  FilterMapper,
  EventDispatcher,
  GridMapper,
  Grid,
  ToolbarMapper,
  Toolbar,
  FormMapper,
  Form
}

