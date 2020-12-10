import {Auth} from "@nuxtjs/auth-next";
import VueI18n, {IVueI18n} from "vue-i18n";
import {NuxtVueI18n} from "nuxt-i18n";
import VueRouter from 'vue-router'
import moment from 'moment'
import NuxtI18nInterface = NuxtVueI18n.Options.NuxtI18nInterface;

interface NuxtApp {
  i18n: VueI18n & IVueI18n & NuxtI18nInterface
  $auth: Auth
  router: VueRouter
  $moment: typeof moment
  localePath: Function
}

export default NuxtApp;
