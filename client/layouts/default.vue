<template>
  <div class="app">
    <div class="the__header">
      <the-header/>
    </div>

    <main class="the__main">
      <nuxt/>
    </main>

    <the-drawer :drawer="drawer"/>

  </div>
</template>

<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters, mapMutations} from "vuex";

@Component({
  inheritAttrs: false,
  methods: mapMutations({
    change: 'aside/change',
  }),
  computed: mapGetters({
    'opened': 'aside/opened',
  }),
})
export default class extends Vue {
  private opened!: boolean;
  private change!: (value: boolean) => void;

  public get drawer() {
    return this.opened;
  }

  public set drawer(value) {
    this.change(value)
  }
}

</script>

<style scoped lang="scss">

.app {
  min-height: 100vh;
  display: grid;
  grid-template-rows: 4.5rem 1fr;
  grid-template-columns: 1fr;
}


.the__header {
  grid-row: 1/span 1;
  grid-column: 1/span 1;
}

.the__main {
  grid-row: 2/span 1;
  grid-column: 1/span 1;
}

.the__main {
  width: 100%;
  max-width: 40rem;
  min-width: 22.5rem;

  margin: 2rem auto 0 auto;
}

.el-menu {
  display: none;
}

@media screen and (min-width: 45em) {
  .el-menu {
    display: block;
  }
}

</style>

