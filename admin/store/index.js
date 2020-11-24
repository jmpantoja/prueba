export const state = () => ({
  items: [],
  drawer: true,
})

export const mutations = {

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
