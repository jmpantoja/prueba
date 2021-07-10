<template>
  <ad-toolbar title="admin.genre.title">
    btn1 / btn2 / btn3
  </ad-toolbar>
</template>

<script lang="ts">

import {Component, Vue} from 'nuxt-property-decorator'
import Toolbar from '~/components/Ad/Toolbar.vue'

@Component({
  name: 'GenreToolbar'

})
export default class extends Vue {

}
</script>

<style scoped lang="scss">

</style>
