<template>
  <section>

    esto es rating
  </section>

</template>


<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";

@Component({
  name: 'Play',
  computed: mapGetters({
    'user': 'user/user',
  }),
})
export default class extends Vue {


}
</script>

<style scoped lang="scss">


</style>


