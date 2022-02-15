<template>
  <el-button class="button-home">
    <img class="big" src="https://dummyimage.com/100x32/">
    <img class="small" src="https://dummyimage.com/32x32/">
  </el-button>
</template>

<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters, mapMutations} from 'vuex'

@Component({
  inheritAttrs: false,
  name: 'ButtonHome',
})
export default class extends Vue {
  opened?: boolean;
}
</script>

<style scoped lang="scss">
.button-home {
  border: none;
  padding: 0;
}

.small {
  display: block;
}

.big {
  display: none;
}

@media screen and (min-width: 65em) {
  .small {
    display: none;
  }
  .big {
    display: block;
  }
}

</style>
