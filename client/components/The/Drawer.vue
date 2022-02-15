<template>
  <el-drawer
    :visible.sync="drawer"
    direction="ltr">

    <the-navbar/>

  </el-drawer>
</template>
<script lang="ts">
import {Component, Vue} from "nuxt-property-decorator";
import {mapGetters, mapMutations} from "vuex";

@Component({
  inheritAttrs: false,
  name:'TheDrawer',
  methods: mapMutations({
    change: 'aside/change',
  }),
  computed: mapGetters({
    'opened': 'aside/opened',
  }),
})
export default class extends Vue {
  private opened!: boolean;
  private change!;

  public get drawer() {
    return this.opened;
  }

  public set drawer(value) {
    this.change(value)
  }
}
</script>

