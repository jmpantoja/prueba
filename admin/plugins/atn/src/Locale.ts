import {NuxtVueI18n} from "nuxt-i18n";
import {RouteConfig} from "@nuxt/types/config/router";
import {IVueI18n} from "vue-i18n";
import moment from 'moment'
import LocaleObject = NuxtVueI18n.Options.LocaleObject;
import {Location} from "vue-router";
import RolesManager from "~/plugins/atn/src/RolesManager";

type Options = {
  i18n: IVueI18n,
  localePath: Function,
  moment: typeof moment
}

class Locale {
  private context: Options;

  public constructor(context: Options) {
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
    this.context.moment.locale(momentLocale)
  }

  translate(text: string): string {
    return this.context.i18n.t(text).toString()
  }

  url(path?: Location): string {
    return this.context.localePath(path)
  }

}

export default Locale;
