export default {
  state() {
    return {
      opened: window.innerWidth >= 1248
    }
  },
  getters: {
    opened: state => state.opened,
    closed: state => !state.opened,
  },
  mutations: {
    toggle(state) {
      state.opened = !state.opened
    }
  }

}
