import menu from '../config/menu';

import {GetterTree} from 'vuex'

type State = ReturnType<typeof state>

const state = () => ({
  menu: menu
})

const getters: GetterTree<State, State> = {
  menu: (state: State) => {
    return state.menu
  },
}


export default {
  state,
  getters
}
