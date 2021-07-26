import {Component, mixins} from 'nuxt-property-decorator'
import {AxiosResponse} from "axios";
import Action from "~/mixins/Action";

@Component({
  name: 'EntityAction',
})
export default class extends mixins(Action) {
  protected entity: object = {}

  public async fetch() {
    const id = this.$route.params.id
    if (!id) {
      return
    }

    const endpoint = this.admin.endpoint
    const url = `${endpoint}/${id}`

    await this.$api.GET(url)
      .then((response: AxiosResponse) => {
        this.entity = response['data']
      })
      .catch((error: Error) => {
        alert('error')
      })
  }

}
