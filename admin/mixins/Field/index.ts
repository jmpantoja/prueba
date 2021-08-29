import {Component, Emit, Prop, Vue, Watch} from 'nuxt-property-decorator'

const _ = require("lodash")

@Component({
  name: 'Field',
})
export default class extends Vue {
  @Prop({required: false, type: String}) prop!: string
  @Prop({required: false, type: String}) label!: string
  @Prop({required: false, type: Object}) value!: {}


  @Watch('data', {'deep': true, immediate: false})
  @Emit('input')
  dataUpdated(value: object) {
  }

  @Watch('value', {'deep': true, immediate: false})
  public update(value: object, old: object) {
    if (_.isEqual(value, old)) {
      return
    }

    this.data = this.defaults(_.cloneDeep(this.value))
  }

  public data: Object = this.defaults(_.cloneDeep(this.value))

  public defaults(data: Object): Object {
    return data
  }
}



