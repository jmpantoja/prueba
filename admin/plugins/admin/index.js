import Vue from 'vue'
import components from "./components";

Object.defineProperty(Vue.prototype, '$_', {value: _});

Object.entries(components).forEach(function ([name, component]) {
  Vue.component(name, component)
});

export default ({app}, inject) => {

  const options = require('~/config/admin')


  // app.url = new AdminUrl(app.router)
  //
  // const adminStack = new AdminStack()
  // options.defineStack(adminStack, app)
  //
  // inject('adminStack', adminStack)
}
