import {AdminContext} from "../../types";
import Locale from "../ui/Locale";
import {RouteConfig} from "@nuxt/types/config/router";
import {NuxtVueI18n} from "nuxt-i18n";
import LocaleObject = NuxtVueI18n.Options.LocaleObject;

declare module '@nuxt/types' {
  interface Context {
    $route: Route
  }
}

class Route {
  private context: AdminContext;
  private locale: Locale;

  public constructor(locale: Locale, context: AdminContext) {
    this.context = context
    this.locale = locale

    // this.addRoute({
    //   path: '/crud/:admin',
    //   name: 'crud',
    //   component: crud
    // })

  }

  public addRoute(route: RouteConfig) {
    const locales = this.locale.avaiables

    locales.forEach((locale: string | LocaleObject) => {
      let code = locale
      if (typeof locale === 'object') {
        code = locale.code
      }

      this.context.router.addRoutes([{
        path: `/${code}${route.path}`,
        name: `${route.name}___${code}`,
        component: route.component
      }])
    })
  }

}

export default Route;
