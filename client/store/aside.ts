import {GetterTree, MutationTree} from 'vuex'

type State = ReturnType<typeof state>
const state = () => ({
  opened: false
})

const getters: GetterTree<State, State> = {
  opened: (state: State) => {
    return state.opened
  },
  closed: (state: State) => {
    return !state.opened
  },
}

const mutations: MutationTree<State> = {
  toggle(state: State) {
    state.opened = !state.opened
  },
  change(state: State, value) {
    state.opened = value
  },
  open(state: State) {
    state.opened = true
  },
  close(state: State) {
    state.opened = false
  }
}

export default {
  state,
  getters,
  mutations
}
