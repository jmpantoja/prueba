<template>
  <el-button
    type="primary"
    circle
    icon="fas el-icon-fa-bars"
    @click="toggle">
  </el-button>
</template>

<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters, mapMutations} from 'vuex'

@Component({
  name: 'Toggle',
  computed: mapGetters({
    'opened': 'aside/opened',
  }),
  methods: mapMutations({
    'toggle': 'aside/toggle'
  })
})
export default class extends Vue {
  opened?: boolean;
}
</script>

<style scoped lang="scss">
.el-button {
  font-size: 1.4em;
}

</style>
