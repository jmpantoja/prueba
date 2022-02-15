<template>
  <section class="home">
    <div>
      /home

    </div>
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

.home .card {
  box-sizing: border-box;
  float: left;

  background-color: green;
  width: 1%;

}

</style>


