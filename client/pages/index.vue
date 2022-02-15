<script lang="ts">
import {Component, Vue} from "nuxt-property-decorator";
import {mapGetters} from "vuex";

@Component({
  name: 'Index',
  computed: mapGetters({
    'user': 'user/user',
  }),
})
export default class extends Vue {
  middleware({store, redirect, localePath}) {
    const user = store.getters['user/user']

    if (user) {
      return redirect(localePath('home'))
    }

    return redirect(localePath('login'))
  }
}
</script>

<style scoped lang="scss">

</style>


