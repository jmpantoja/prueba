<template>
  <v-app class="app">
    <admin-drawer/>
    <admin-toolbar/>
    <v-main>
      <admin-page-header/>
      <transition name="fade">
        <nuxt/>
      </transition>
      <!--      <app-toast/>-->
    </v-main>
  </v-app>

</template>

<script>
import {useContext} from '@nuxtjs/composition-api'

export default {
  head(){
    return {
      title: this.title
    }
  },
  setup(){
    let {$locale} = useContext()
    return {
      title: $locale.translate('app.title')
    }
  }
}
</script>

<style lang="scss">
.container {
  padding: 0;
}
</style>
