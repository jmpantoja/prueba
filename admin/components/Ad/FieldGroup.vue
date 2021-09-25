<template>
  <fieldset class="field-group" :class="{'is-error':!valid}">
    <legend>{{ title }}</legend>
    <slot/>
  </fieldset>
</template>

<script lang="ts">
import {Component, Inject, Prop, Vue, Watch} from 'nuxt-property-decorator'
import {Admin} from "~/src/Admin";
import Form from "~/components/Ad/Form.vue";
import Field from "~/mixins/Field";

@Component({
  name: 'FieldGroup',
  components: {Field},
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
    if (valid !== this.valid) {
      this.valid = valid
      this.adForm.validateGroup(this._name, this.valid);
    }

  }

  private mounted() {
    this._propNames = this.findProps(this.$children)
    this._name = `fieldset-${this._uid}`
    const rect = this.$el.getBoundingClientRect();
    const position = rect.top - rect.height - 90;// - (15 * 4)

    this.adForm.addGroup({
      title: this.title,
      name: this._name,
      position
    })

    this.adForm.$on('validate', this.onValidate)
    this.adForm.$on('clearValidate', () => {
      this.$set(this, 'errorBag', {})
    })

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
fieldset.field-group {
  position: relative;
  margin-top: 2.6rem;

  border-radius: 4px;
  margin-bottom: 4em;
  padding-top: 3em;
  padding: 3em 2rem 0 2rem;
  box-shadow: 10px 10px 5px $--border-base;
  border: $--border-base;
  background: white;

  legend {
    position: absolute;
    top: -2.8rem;
    left: 2px;

    font-size: 2.2rem;
    font-weight: lighter;
    color: #555 !important;

    text-transform: capitalize;
  }

  &.is-error {
    border-color: $--color-danger-light-4;

    legend {
      color: $--color-danger;
    }
  }

  & > .el-form-item {
    margin-bottom: 2.5rem;
    display: flex;
    flex-direction: row;

    ::v-deep > .el-form-item__label {
      display: flex;
      align-items: start;

      font-size: 1.2rem;
      font-weight: 300;
      text-transform: capitalize;

      width: 20%;
      margin-right: -1.5rem;
      padding: 0;

      color: #666 !important;

      &::after {
        content: ":";
      }
    }

    ::v-deep > .el-form-item__content {
      //border: solid 1px blue;
      flex: 1;

      display: flex;
      flex-direction: row;

      .el-form-item {
        margin-left: 1.5rem;
        //border: solid 1px red;
        flex: 1;

        display: flex;
        flex-direction: column;


        .el-form-item__label {
          padding: 0;
          margin: 0 0 3px 0;
          font-size: 0.9rem;
          line-height: 0.9rem;
        }
      }
    }

  }
}

</style>
