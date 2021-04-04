import Vue from 'vue'
import {admins, menu, roles} from '~/config/admin'

import {AdminManager, Locale, Panel, RolesManager} from "~/plugins/atn/src";
import ClientManager from "~/plugins/atn/src/ClientManager";


const _ = require('lodash')

function importAll(r) {
  r.keys().forEach((key) => {
    const component = r(key).default
    Vue.component(component.name, component)
  });
}

importAll(require.context('./components', true, /^.*\.vue/))
importAll(require.context('~/components', true, /^.*\.vue/))

Object.defineProperty(Vue.prototype, '$_', {value: _});

export default ({app}, inject) => {
  app.security = new RolesManager(roles)
  inject('security', app.security)

  const locale = new Locale({
    i18n: app.i18n,
    localePath: app.localePath,
    moment: app.$moment
  });
  inject('locale', locale)

  const adminManager = new AdminManager(admins, app)
  inject('adminManager', adminManager)

  const clientManager = new ClientManager(admins, app)
  inject('client', clientManager)
}
