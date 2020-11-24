const notifier = (store) => ({

  showMessage({title = '', detail = '', color = '', icon = ''}) {
    store.commit('snackbar/showMessage', {title, detail, color, icon})
  },

  success(title, detail) {
    this.showMessage({
      title,
      detail,
      icon: 'mdi-checkbox-marked-circle',
      color: 'success'
    })
  },

  fail(title, detail) {
    this.showMessage({
      title,
      detail,
      icon: 'mdi-alert-circle',
      color: 'error'
    })
  }

})


export default ({app, store}, inject) => {
  inject('notifier', notifier(store))
}
