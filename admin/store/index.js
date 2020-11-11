//const cookieparser = process.server ? require('cookieparser') : undefined

export const state = () => ({
  token: localStorage['auth._token.local'],
  drawer: true,
})

export const getters = {
  koko(state) {
    return state.token
  }
}

export const mutations = {
  // token(state, token) {
  //   var base64Url = token.split('.')[1];
  //   var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
  //   var jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
  //     return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
  //   }).join(''));
  //
  //   state.roles = JSON.parse(jsonPayload).roles;
  //
  // },
  toggleDrawer(state) {
    state.drawer = !state.drawer
  },
  drawer(state, val) {
    state.drawer = val
  },
}


//
// export const actions = {
//   nuxtServerInit({commit}, {req}) {
//     let auth = null
//     if (req.headers.cookie) {
//       const parsed = cookieparser.parse(req.headers.cookie)
//       try {
//         auth = JSON.parse(parsed.auth)
//       } catch (err) {
//         // No valid cookie found
//       }
//     }
//     commit('setAuth', auth)
//   }
// }
