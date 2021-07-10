export default {
  state() {
    return {
      opened: true
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
