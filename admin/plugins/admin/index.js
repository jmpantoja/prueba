import Vue from 'vue'
import components from "./components";
import {reactive} from '@nuxtjs/composition-api'
import _ from 'lodash';
import {Drawer, FullScreen, Locale, Menu, Profile, Route} from './src/ui'

import {AdminStack, AdminUrl} from "./types";


Object.defineProperty(Vue.prototype, '$_', {value: _});

Object.entries(components).forEach(function ([name, component]) {
  Vue.component(name, component)
});

export default ({app}, inject) => {

  const options = require('~/config/admin')
  options.declareComponents()

  const drawer = new Drawer()
  inject('drawer', reactive(drawer))

  const fullScreen = new FullScreen(window.document)
  inject('fullScreen', fullScreen)

  const locale = new Locale(app)
  inject('locale', locale)

  const menu = new Menu(locale, options.menu)
  inject('menu', menu)

  const profile = new Profile(app)
  inject('profile', profile)

  const route = new Route(locale, app)
  inject('route', route)


  app.url = new AdminUrl(app.router)

  const adminStack = new AdminStack()
  options.defineStack(adminStack, app)

  inject('adminStack', adminStack)
}
