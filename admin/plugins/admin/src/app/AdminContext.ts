import {Auth} from "@nuxtjs/auth-next";
import VueI18n, {IVueI18n} from "vue-i18n";
import {NuxtVueI18n} from "nuxt-i18n";
import VueRouter from 'vue-router'
import moment from 'moment'
import {NuxtAxiosInstance} from '@nuxtjs/axios'
import NuxtI18nInterface = NuxtVueI18n.Options.NuxtI18nInterface;
import AdminUrl from "../admin/AdminUrl"

interface AdminContext {
  i18n: VueI18n & IVueI18n & NuxtI18nInterface
  $auth: Auth
  router: VueRouter
  $moment: typeof moment
  localePath: Function,
  $axios: NuxtAxiosInstance,
  url: AdminUrl
}

export default AdminContext;
