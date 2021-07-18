import {Component, Prop, Vue} from 'nuxt-property-decorator'
import {AdminContext} from "~/types";

@Component({
  name: 'Context',
})
export default class extends Vue {
  @Prop({required: true, type: Object as () => AdminContext}) context!: AdminContext
  @Prop({required: false, type: Array as () => string[]}) public roles!: string[]

  public get endpoint(): string {
    return this.context.endpoint
  }

  public get allowed() {
    return this.$security.isGranted(this.roles || [])
  }
}
