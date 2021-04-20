import Vue from 'vue'
import {admins, menu, roles} from '~/config/admin'
import {ActionManager, AdminManager, Locale, Panel, RolesManager} from "~/plugins/atn/src";
const _ = require('lodash')


Vue.mixin({
  methods: {
    t(key, params) {
      if(!key){
        return ''
      }

      var name = key
      if(this.namespace){
        name = `admin.${this.namespace}.${key}`;
      }
      return this.$t(name, params);
    }
  }
})


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

  const actionManager = new ActionManager(app.security, admins)
  inject('actionManager', actionManager)

  const adminManager = new AdminManager(actionManager,  admins, app)
  inject('adminManager', adminManager)

}
