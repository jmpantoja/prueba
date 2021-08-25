import {Component, Provide, Vue} from 'nuxt-property-decorator'
import {Context} from "~/types/";
import {RouteMeta} from "~/types/route";
import {Admin} from "~/types/admin";

@Component({
  name: 'Action',
})
export default class extends Vue {
  @Provide('admin') protected admin!: Admin;

  public async asyncData({route, security, adminManager}: Context) {
    const metas = (route.meta as RouteMeta[])
    const meta = (metas[0] as RouteMeta)

    const admin = adminManager.byName(meta.admin).setView(meta.view)
    const roles = admin.rolesByName(meta.view)

    security.assert(roles)

    return {
      components: meta.components,
      admin,
    }
  }
}
