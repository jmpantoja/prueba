import {NuxtApp} from "../types";
import {NuxtVueI18n} from "nuxt-i18n";
import LocaleObject = NuxtVueI18n.Options.LocaleObject;
import {RouteConfig} from "@nuxt/types/config/router";

declare module '@nuxt/types' {
  interface Context {
    $locale: Locale
  }
}

class Locale {
  private app: NuxtApp;

  public constructor(app: NuxtApp) {
    this.app = app
  }

  get avaiables(): (string | LocaleObject)[] {
    return this.app.i18n.locales || []
  }

  get current(): string {
    return this.app.i18n.locale
  }

  public change(locale: string){
    this.app.i18n.setLocale(locale)

    let momentLocale = locale === 'en' ? 'en-gb' : locale;
    this.app.$moment.locale(momentLocale)
  }

  translate(text: string): string {
    return this.app.i18n.t(text).toString()
  }

  url(path: RouteConfig): string {
    return this.app.localePath(path)
  }

}

export default Locale;
