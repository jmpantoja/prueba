<template>
  <div class="header">
    <app-sidebar-toggle/>
  </div>
</template>

<script>
import {Component, Vue} from 'nuxt-property-decorator'

@Component({
  inheritAttrs: false,
  name: 'Header',

})
export default class extends Vue {


}

</script>

<style scoped lang="scss">

</style>
