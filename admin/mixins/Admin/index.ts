import {Component, Inject, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";


@Component({
  name: 'Admin',
})
export default class extends Vue {
  @Inject('admin') public admin!: Admin
}
