import {ActionTree, GetterTree} from 'vuex'

type State = ReturnType<typeof state>

const state = () => ({})

const getters: GetterTree<State, State> = {
  user: (state: State) => {
    // @ts-ignore
    const nuxt = $nuxt
    return nuxt.$auth.user
  },
  roles: (state: State, getters: GetterTree<State, State>) => {
    const user = (getters.user as unknown)
    return (user as { roles: string[] }).roles || []
  },
}

const actions: ActionTree<State, any> = {
  logout(context) {
    // @ts-ignore
    const nuxt = $nuxt

    nuxt.$auth.logout()
      .then(() => {
        const next = nuxt.$auth.options.redirect.logout
        nuxt.$router.push(next)
      })
  }
}

export default {
  state,
  getters,
  actions
}
