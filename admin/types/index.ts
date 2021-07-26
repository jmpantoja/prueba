import {Security} from "~/types/security";
import {Api} from "~/src/Api";
import {Context} from "@nuxt/types";
import {AdminManager} from "~/types/admin";

declare module '@nuxt/types' {
  interface Context {
    adminManager: AdminManager
    security: Security
    api: Api
  }

  interface NuxtAppOptions {
    adminManager: AdminManager
    security: Security,
    api: Api
  }
}

declare module 'vue/types/vue' {
  interface Vue {
    $adminManager: AdminManager
    $security: Security,
    $api: Api
  }
}

export {
  Context
}



