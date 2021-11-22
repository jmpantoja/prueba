<template>
  <div class="app" :class="{collapsed: closed}">
    <aside class="app__sidebar">
      <app-menu/>
    </aside>
    <section class="app__container">
      <header class="app__header">
        <app-header/>
      </header>
      <main class="app__page">
        <nuxt/>
      </main>
    </section>
  </div>
  <!--  <nuxt/>-->
</template>

<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";

@Component({
  inheritAttrs: false,
  name: 'Menu',
  computed: mapGetters({
    'closed': 'aside/closed',
  })

})
export default class extends Vue {
  onOpen() {
  }

  onClose() {
  }

}

</script>

<style scoped lang="scss">

.app {
  min-height: 100vh;
  background-color: palegoldenrod;
}

.app__container {
  background-color: paleturquoise;
}

.app__sidebar {
  background-color: #41403d;

  .el-menu {
    border-right: 1px solid transparent;
  }
}

.app__header {
  background-color: pink;
  border-bottom: $--border;
}

.app__container {
  background-color: palegreen;
}

//mobile
.app {
  display: flex;
}

.app__container {
  flex-grow: 1;
}

.app.collapsed {
  .app__sidebar {
    display: none;
  }
}


@media screen and (min-width: 60em) {

  .app__sidebar {
    display: block;
  }
}


</style>

