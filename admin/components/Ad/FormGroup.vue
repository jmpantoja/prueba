<template>
  <fieldset :class="{'is-error':!valid}">
    <legend>{{ title }}</legend>
    <slot/>
  </fieldset>
</template>

<script lang="ts">
import {Component, Inject, Prop, Vue, Watch} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";
import Form from "~/components/Ad/Form.vue";

@Component({
  name: 'FormGroup',
})
export default class extends Vue {
  @Prop({required: true, type: String}) title!: string;
  @Inject('admin') private admin!: Admin
  @Inject('adForm') private adForm!: Form

  public name: string = '';
  public valid: boolean = true;

  public errorBag = {}
  private _uid!: string;
  private _propNames: string[] = [];
  private _name!: string;

  @Watch('errorBag', {deep: true})
  updateError(val: object) {
    const valid = !Object.values(val).includes(false)
    if(valid !== this.valid){
      this.valid = valid
      this.adForm.validateGroup(this._name, this.valid);
    }

  }


  private mounted() {
    this._propNames = this.findProps(this.$children)
    this._name = `fieldset-${this._uid}`
    const rect = this.$el.getBoundingClientRect();
    const position = rect.top - rect.height;// - (15 * 4)

    this.adForm.addGroup({
      title: this.title,
      name: this._name,
      position
    })

    this.adForm.$on('validate', this.onValidate)
  }

  private onValidate(prop: string, valid: boolean) {
    if (!this._propNames.includes(prop)) return

    this.$set(this.errorBag, prop, valid)

  }

  private findProps($children: Vue[]): string[] {
    const props: string[] = [];

    $children.forEach((child: Vue) => {
      props.push(child.$props.prop, ...this.findProps(child.$children))
    })

    return props.filter((prop: string | undefined, index: number, self) => {
      return prop && self.indexOf(prop) === index
    });
  }
}
</script>

<style scoped lang="scss">
fieldset.is-error {
  border: solid 1px $--color-danger;
 // background-color: $--color-danger-lighter;

  legend {
    color: $--color-danger;
  }
}
</style>
