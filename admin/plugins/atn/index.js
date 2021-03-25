import Vue from 'vue'
import {admins} from '~/config/admin'
import {AdminManager} from "~/plugins/atn/src";

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
  const adminManager = new AdminManager(admins, app)
  inject('adminManager', adminManager)
}
