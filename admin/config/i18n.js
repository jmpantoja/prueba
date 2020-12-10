export default {
  locales: [
    {code: 'en', file: 'en.js', flag: 'gb', rtl: false},
    {code: 'es', file: 'es.js', flag: 'es', rtl: false},
  ],
  defaultLocale: 'es',
  vueI18nLoader: true,
  lazy: true,
  langDir: 'lang/',
  parsePages: false,
  detectBrowserLanguage: {
    useCookie: true,
    cookieKey: 'i18n_redirected',
    alwaysRedirect: true,
    fallbackLocale: null
  },
  strategy: 'prefix'
}
