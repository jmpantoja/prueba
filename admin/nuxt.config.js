import colors from 'vuetify/es5/util/colors'

export default {
  ssr: false,

  head: {
    title: 'Nuxt Vuetify 2',
    meta: [
      {charset: 'utf-8'},
      {name: 'viewport', content: 'width=device-width, initial-scale=1'},
      {hid: 'description', name: 'description', content: process.env.npm_package_description || ''}
    ],
    link: [
      {rel: 'icon', type: 'image/x-icon', href: '/favicon.ico'}
    ]
  },

  loading: {color: '#fff'},

  css: [
    '~/assets/styles/app.scss'
  ],

  plugins: [
    '~plugins/notifier.js',
    '~plugins/common.js',
    '~plugins/axios.js',
    '~plugins/admin.js',
  ],

  modules: [
    '@nuxtjs/axios',
    'nuxt-i18n',
    '@nuxtjs/vuetify',
    'vue-chimera/nuxt',
    '@nuxtjs/auth-next',
    '@nuxtjs/moment'
  ],
  build: {
    extend(config, ctx) {

    }
  },

  router: {
    middleware: ['auth']
  },

  axios: {
    baseURL: process.env.API_ENDPOINT,
    headers: {
      common: {
        'Accept': 'application/ld+json'
      },
    }
  },
  auth: {
    localStorage: false,
    scopeKey: 'roles',
    redirect: {
      login: '/es/login',
      logout: '/es/login',
      callback: '/login',
      //home: '/en'
    },
    cookie: {
      options: {
        secure: true
      }
    },
    strategies: {
      local: {
        scheme: 'refresh',
        token: {
          property: 'token',
          maxAge: 1800,
          // required: true,
          // type: 'Bearer'
        },
        refreshToken: {
          property: 'refresh_token',
          data: 'refresh_token',
          maxAge: 60 * 60 * 24 * 30
        },
        user: {
          property: 'user',
          // autoFetch: true
        },
        endpoints: {
          login: {url: process.env.TOKEN_URL, method: 'post'},
          // logout: {url: '/api/auth/logout', method: 'post'},
          refresh: {url: process.env.REFRESH_TOKEN_URL, method: 'post'},
          user: {url: process.env.PROFILE_URL, method: 'get'},
          logout: false,
        }
      }
    }
  },
  moment: {
    defaultLocale: 'es',
    locales: ['en-gb', 'es']
  },
  i18n: {
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
  },

  chimera: {},

  vuetify: {
    customVariables: ['~/assets/styles/variables.scss'],
    treeShake: true,
    rtl: false,
    lang: {
      locales: {en: {}, es: {}},
      t(key, ...params) {
        return window.$nuxt.$i18n.t(key, params)
      },
      current: 'es'
    },
    theme: {
      light: true,
      themes: {
        light: {
          primary: colors.blue.darken2,
          accent: colors.grey.darken3,
          secondary: colors.amber.darken3,
          info: colors.teal.lighten1,
          warning: colors.amber.base,
          error: colors.deepOrange.accent4,
          danger: colors.deepOrange.darken2,
          success: colors.green.darken3,
        }
      }
    }
  }
}
