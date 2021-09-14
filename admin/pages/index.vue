<template>
  <div class="container">
    <ad-form-dialog use="movies" />

  </div>
</template>


<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";

@Component({
  name: 'Dashboard',
  computed: mapGetters({
    'user': 'user/user',
  }),
})
export default class extends Vue {

  public get admin() {
    return this.$adminManager.byName('genres')
  }

}

</script>


