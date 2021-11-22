<template>
    <el-button circle icon="el-icon-s-fold" @click="toggle"/>
</template>
<script>
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters, mapMutations} from 'vuex'


@Component({
  inheritAttrs: false,
  name: 'Toggle',
  computed: mapGetters({
    'opened': 'aside/opened',
  }),
  methods: mapMutations({
    'toggle': 'aside/toggle'
  })

})
export default class extends Vue {
  //
  // toggle() {
  //   console.log('hola')
  // }
}


</script>
<style scoped lang="scss">
header {
  display: flex;
  align-items: center;
  padding: 1rem;

}
</style>
