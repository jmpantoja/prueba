import {Component, Emit, Prop, Vue, Watch} from 'nuxt-property-decorator'

const _ = require("lodash")

@Component({
  name: 'Field',
})
export default class extends Vue {
  @Prop({required: false, type: String}) prop!: string
  @Prop({required: false, type: String}) label!: string
  @Prop({required: false}) value!: null


  @Watch('data', {'deep': true, immediate: false})
  @Emit('input')
  dataUpdated(value: object) {

  }

  @Watch('value', {'deep': true, immediate: false})
  private update(value: object, old: object) {
    if (_.isEqual(value, old)) {
      return
    }

    this.data = this.defaults(_.cloneDeep(this.value))
  }

  public data: any = this.defaults(_.cloneDeep(this.value))

  public defaults(data: any): any {
    return data
  }

  public override(base: object, props: object) {

    const keys = Object.keys(base)
    props = _.omitBy(props, (value: any) => {
      return value === undefined
    })

    const combine = {
      ...this.$props,
      ...props
    }

    return _.pick(combine, keys)
  }
}



