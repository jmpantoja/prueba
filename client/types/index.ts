import {Security} from "~/types/security";
import {Api} from "~/src/Api";
import {Context} from "@nuxt/types";
declare module "element-ui";


declare module '@nuxt/types' {
  interface Context {
    security: Security
    api: Api
  }

  interface NuxtAppOptions {
    security: Security,
    api: Api
  }
}

declare module 'vue/types/vue' {
  interface Vue {
    $security: Security,
    $api: Api
  }
}

export {
  Context
}



