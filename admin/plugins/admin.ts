import {Context} from "@nuxt/types";
import {AdminContext, AdminManager} from "~/types/admin";
import config from "~/config/admin"


export default (context: Context, inject: Function) => {

  // console.log(context.env)
  // console.log(context.app)

  const admiContext: AdminContext = {
    api_endpoint: context.env.API_ENDPOINT,
    localePath : context.app.localePath
  }

  const adminManager = new AdminManager(config, admiContext);



  context.adminManager = adminManager
  inject('adminManager', adminManager)

}
