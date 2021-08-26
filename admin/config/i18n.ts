// https://phrase.com/blog/posts/nuxt-js-tutorial-i18n/#Date_and_time_localization
import {dateTimeFormats, numberFormats} from "./locale";

export default {
  locales: [
    {code: 'en', file: 'en.ts', flag: 'gb', rtl: false},
    {code: 'es', file: 'es.ts', flag: 'es', rtl: false},
  ],
  defaultLocale: 'es',
  vueI18nLoader: true,
  lazy: true,
  langDir: 'lang/',
  parsePages: false,
  vueI18n: {
    dateTimeFormats,
    numberFormats
  },
  detectBrowserLanguage: {
    useCookie: true,
    cookieKey: 'i18n_redirected',
    alwaysRedirect: true,
    fallbackLocale: null
  },
  strategy: 'prefix'
}
