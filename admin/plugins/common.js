import Vue from 'vue'
import _ from 'lodash';

Object.defineProperty(Vue.prototype, '$_', { value: _ });

Vue.filter('uppercase', val => val.toUpperCase())

const utils = {
  isEmpty(value) {
    value = value || {}
    if (typeof value === 'number' && value !== 0) {
      return false
    }
    return Object.keys(value).length <= 0
  },
  filter(value) {
    return _.filter(value)
  },
  replace(text, vars) {
    var replaced = text;
    for (var name in vars) {
      let regex = new RegExp(`{${name}}`, 'g')
      replaced = replaced.replace(regex, vars[name]);
    }
    return replaced;
  },
  call(callback, ...params) {
    if (typeof callback !== 'function') {
      return
    }
    callback.call(this, ...params)
  },
}

export default (ctx, inject) => {
  ctx.$utils = utils
  inject('utils', utils)
}
