import {Component, mixins} from 'nuxt-property-decorator'
import Action from "~/mixins/Action";
import {Entity} from "~/types/api";

const _ = require("lodash")

const delay = (ms: number) => new Promise(res => setTimeout(res, ms));

@Component({
  name: 'EntityAction',
})
export default class extends mixins(Action) {
  protected entity: Entity = {id: null}

  public async fetch() {

    const id = this.$route.params.id
    if (!id) {
      return
    }

    await this.admin.findOne(id)
      .then((entity: Entity) => {
        this.entity = entity
      })
  }


  public get waiting(): boolean {
    if (this.admin.view === 'create') {
      return false;
    }
    return this.entity.id === null
  }
}
