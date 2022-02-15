import {Context} from "@nuxt/types";
import {Api} from "~/types/api";


export default (context: Context, inject: Function) => {
  const api = new Api(context);
  context.api = api
  inject('api', api)
}
