import Vue from 'vue'
var VueCookie = require('vue-cookie');

Vue.use(VueCookie);
Vue.filter('uppercase', val => val.toUpperCase())
