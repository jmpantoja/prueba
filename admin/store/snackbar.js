export const state = () => ({
  title: '',
  detail: '',
  color: '',
  icon: null
})

export const mutations = {
  showMessage(state, payload) {
    state.title = payload.title
    state.detail = payload.detail
    state.color = payload.color
    state.icon = payload.icon
  }
}
