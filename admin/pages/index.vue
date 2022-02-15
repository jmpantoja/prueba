<template>
  <div class="container">
    {{ user }}
    <hr/>
    <hr/>

    <div v-roles="['entry_edit']">
      <h1>hola</h1>
    </div>

  </div>
</template>


<script lang="ts">
import {Component, Provide, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";

@Component({
  name: 'Dashboard',
  computed: mapGetters({
    'user': 'user/user',
  }),
})
export default class extends Vue {
  @Provide('admin')
  public get admin() {
    return this.$adminManager.byName('entry')
  }

  public model: object = {
    fullName: {
      name: 'pepe',
      lastName: 'lopez'
    }
  }
}
</script>

<style scoped lang="scss">


</style>


