import {Component, Vue} from 'nuxt-property-decorator'
import {AdminContext, Context, RouteMeta} from "~/types";

@Component({
  name: 'Action',
})
export default class extends Vue {
  private roles!: Extract<RouteMeta, 'roles'>;
  private endpoint!: Extract<RouteMeta, 'endpoint'>;
  private actions!: Extract<RouteMeta, 'actions'>;

  public async asyncData({route, security}: Context) {
    const metas = (route.meta as RouteMeta[])
    const meta = (metas[0] as RouteMeta)

    security.assert(meta.roles)

    return {
      endpoint: meta.endpoint,
      components: meta.components,
      actions: meta.actions
    }
  }

  public get context(): AdminContext {
    return {
      endpoint: this.endpoint,
      actions: this.actions
    }
  }
}
