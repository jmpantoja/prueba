<template>
  <section class="home">

    /home
    <!--    <header>-->
    <!--      <app-shortcut>-->
    <!--        Verbos Irregulares-->
    <!--      </app-shortcut>-->

    <!--      <app-shortcut>-->
    <!--        Vocabulario-->
    <!--      </app-shortcut>-->

    <!--      <app-shortcut>-->
    <!--        Collocations-->
    <!--      </app-shortcut>-->

    <!--      <app-shortcut>-->
    <!--        Phrasal Verbs-->
    <!--      </app-shortcut>-->

    <!--    </header>-->

    <!--    <aside>-->

    <!--    </aside>-->

    <!--    <main>-->
    <!--      main-->
    <!--    </main>-->

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


