import Vue from 'vue'
import components from "./components";
import {reactive} from '@nuxtjs/composition-api'

import FullScreen from "./src/ui/FullScreen";
import Drawer from "./src/ui/Drawer";
import Menu from "./src/ui/Menu";
import Locale from "./src/ui/Locale";
import Profile from "./src/ui/Profile";
import Route from "./src/ui/Route";
import AdminStack from "~/plugins/admin/src/AdminStack";

Object.entries(components).forEach(function ([name, component]) {
  Vue.component(name, component)
});

export default ({app}, inject) => {
  const options = require('~/config/admin')

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


  const adminStack = new AdminStack()
  options.defineStack(adminStack)

  inject('adminStack', adminStack)

}
