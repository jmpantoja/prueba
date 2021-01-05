import {AdminContext} from "../../types";
import {NuxtVueI18n} from "nuxt-i18n";
import {RouteConfig} from "@nuxt/types/config/router";
import LocaleObject = NuxtVueI18n.Options.LocaleObject;

declare module '@nuxt/types' {
  interface Context {
    $locale: Locale
  }
}

class Locale {
  private context: AdminContext;

  public constructor(context: AdminContext) {
    this.context = context
  }

  get avaiables(): (string | LocaleObject)[] {
    return this.context.i18n.locales || []
  }

  get current(): string {
    return this.context.i18n.locale
  }

  public change(locale: string) {
    this.context.i18n.setLocale(locale)

    let momentLocale = locale === 'en' ? 'en-gb' : locale;
    this.context.$moment.locale(momentLocale)
  }

  translate(text: string): string {
    return this.context.i18n.t(text).toString()
  }

  url(path: RouteConfig): string {
    return this.context.localePath(path)
  }

}

export default Locale;
