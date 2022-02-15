import {Component, Inject, Prop, Provide, Vue} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";


@Component({
  name: 'AdminAware',
})
export default class extends Vue {

  @Inject({
    from: 'admin',
    default: null
  }) public contextAdmin!: Admin

  @Prop({
    required: false,
    type: String
  }) readonly use!: string;

  @Provide('admin')
  public get admin(): Admin {
    const name = this.use
    if (name) {
      return this.$adminManager.byName(name)
    }

    return this.contextAdmin
  }

}
