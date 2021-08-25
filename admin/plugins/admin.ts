import {Context} from "@nuxt/types";
import {AdminContext, AdminManager} from "~/types/admin";
import config from "~/config/admin"
import VueRouter from "vue-router";


export default (context: Context, inject: Function) => {

  const admiContext: AdminContext = {
    api_endpoint: context.env.API_ENDPOINT,
    localePath: context.app.localePath,
    i18n: context.app.i18n,
    api: context.api,
    router: (context.app.router as VueRouter),
    from: () => {
      return context.from
    }
  }

  const adminManager = new AdminManager(config, admiContext);

  context.adminManager = adminManager
  inject('adminManager', adminManager)

}
