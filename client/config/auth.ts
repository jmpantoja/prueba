export default {
  localStorage: false,
  scopeKey: 'roles',
  redirect: {
    login: 'login',
    logout: 'login',
    callback: 'login',
    home: 'home'
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
  },
  plugins: [
    {src: '~/plugins/auth-i18n.js'}
  ]
}
