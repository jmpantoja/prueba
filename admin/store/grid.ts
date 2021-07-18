import {ActionTree, GetterTree, MutationTree} from 'vuex'
import {QueryGetter, TableQuery} from "~/types";

type State = ReturnType<typeof state>

const state = () => ({
  grid: {} as { [key: string]: object }
})

const getters: GetterTree<State, State> = {
  all: (state: State) => {
    return state.grid
  },
  query(state): QueryGetter {
    return (endpoint: string): TableQuery => {
      return state.grid[endpoint] || {}
    }
  }

}

const mutations: MutationTree<State> = {
  CHANGE_QUERY: (state: State, payload) => {

    const endpoint = (payload.endpoint as string)
    const query = (payload.query as object)

    state.grid[endpoint] = query
  },
}

const actions: ActionTree<State, State> = {
  save({commit}, payload) {
    commit('CHANGE_QUERY', payload)
  }
}


export default {
  state,
  getters,
  mutations,
  actions
}
