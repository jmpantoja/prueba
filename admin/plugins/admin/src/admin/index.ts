import Vue from 'vue';
import Admin from "./Admin";
import ApiClient from "./ApiClient";
import ApiRequest from "./ApiRequest";
import Grid from "./Grid";
import FilterMapper from "./FilterMapper";
import GridMapper from "./GridMapper";
import FormMapper from "./FormMapper";
import Form from "./Form";

const eventBus: {
  $on: (event: string | string[], callback: Function) => typeof eventBus,
  $once: (event: string | string[], callback: Function) => typeof eventBus,
  $off: (event?: string | string[], callback?: Function) => typeof eventBus,
  $emit: (event: string, ...args: any[]) => typeof eventBus,
} = new Vue();

export interface Record {
  id: string,

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

export type ItemAction = {
  icon: string;
};
export type ItemActionList = {
  [key: string]: ItemAction
}

export type FormAction = { label: string, color?: string, slot?: 'left' | 'right' };

export type FormActionList = {
  left: { [key: string]: FormAction },
  right: { [key: string]: FormAction }
}

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
  eventBus,
  Admin,
  ApiClient,
  ApiRequest,
  FilterMapper,
  FormMapper,
  GridMapper,
  Grid,
  Form,
}

