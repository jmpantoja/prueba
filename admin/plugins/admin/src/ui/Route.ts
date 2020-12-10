import {NuxtApp} from "../types";
import Locale from "../ui/Locale";
import {RouteConfig} from "@nuxt/types/config/router";
import {NuxtVueI18n} from "nuxt-i18n";
import LocaleObject = NuxtVueI18n.Options.LocaleObject;
import crud from "~/plugins/admin/pages/crud.vue";

declare module '@nuxt/types' {
  interface Context {
    $route: Route
  }
}

class Route {
  private app: NuxtApp;
  private locale: Locale;

  public constructor(locale: Locale,  app: NuxtApp) {
    this.app = app
    this.locale = locale

    this.addRoute({
      path: '/crud/:admin',
      name: 'crud',
      component: crud
    })

  }

  public addRoute(route: RouteConfig) {
    const locales = this.locale.avaiables

    locales.forEach((locale: string | LocaleObject) => {
      let code = locale
      if (typeof locale === 'object') {
        code = locale.code
      }

      this.app.router.addRoutes([{
        path: `/${code}${route.path}`,
        name: `${route.name}___${code}`,
        component: route.component
      }])
    })
  }

}

export default Route;
