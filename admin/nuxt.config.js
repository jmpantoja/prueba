import config from 'config'
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
        '~plugins/filters.js',
        '~plugins/admin.js',
    ],

    modules: [
        '@nuxtjs/axios',
        'nuxt-i18n',
        '@nuxtjs/vuetify',
        'vue-chimera/nuxt'
    ],

    axios: {
        baseURL: config.get('baseURL')
    },

    build: {
        extend(config, ctx) {

        }
    },

    i18n: {
        locales: [
            {code: 'en', file: 'en.js', flag: 'gb', rtl: false},
            {code: 'es', file: 'es.js', flag: 'es', rtl: false},
            {code: 'fa', file: 'fa.js', flag: 'th', rtl: true},
        ],
        defaultLocale: 'en',
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
            locales: {en: {}, fa: {}},
            t(key, ...params) {
                return window.$nuxt.$i18n.t(key, params)
            },
            current: 'en'
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
                    success: colors.green.accent3,
                }
            }
        }
    }
}
