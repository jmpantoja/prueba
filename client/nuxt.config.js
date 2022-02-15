import config from "./config";

export default {
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'Cliente',
    htmlAttrs: {
      lang: 'es'
    },
    meta: [
      {charset: 'utf-8'},
      {name: 'viewport', content: 'width=device-width, initial-scale=1'},
      {hid: 'description', name: 'description', content: ''}
    ],
    link: [
      {rel: 'icon', type: 'image/x-icon', href: '/favicon.ico'}
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    'element-ui/lib/theme-chalk/index.css',
    '~assets/reset.css',
    '~assets/icomoon.css',
    '~assets/scss'
  ],

  styleResources: {
    scss: ['./assets/scss/*.scss']
  },

  env: {
    API_ENDPOINT: process.env.API_ENDPOINT
  },

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '@/plugins/element-ui',
    '@/plugins/security.ts',
    '@/plugins/api.ts'
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  router: {
    middleware: ['auth']
  },

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/typescript
    '@nuxt/typescript-build'
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    'nuxt-i18n',
    '@nuxtjs/auth-next',
    '@nuxtjs/style-resources'
  ],

  i18n: config.i18n,

  auth: config.auth,

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    baseURL: process.env.API_ENDPOINT,
    headers: {
      common: {
        'Accept': 'application/ld+json',
        'Content-Type': 'application/ld+json'
      }
    }
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: [/^element-ui/]
  }
}
