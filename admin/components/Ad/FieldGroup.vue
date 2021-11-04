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

<style lang="scss">
fieldset.field-group {
  position: relative;
  margin-top: 2.5rem;
  margin-bottom: 6.5rem;

  border-radius: 4px;

  padding: 3em 1rem 0 2rem;
  box-shadow: 10px 10px 5px $--border-base;
  border: $--border-base;
  background: white;

  legend {
    position: absolute;
    top: -3rem;
    left: 2px;

    font-size: 2.2rem;
    font-weight: lighter;
    color: #666 !important;
    text-transform: capitalize;
  }

  &.is-error {
    border-color: $--color-danger-light-4;

    legend {
      color: $--color-danger;
    }
  }

  > .el-form-item {
    margin-bottom: 2rem;
  }
}

.field-group {
  display: flex;
  flex-direction: column;


  > .el-form-item {
    display: flex;
    margin-bottom: 0;

    > .el-form-item__label {
      width: 20%;

      padding: 0;
      font-size: 1.2rem;
      font-weight: 300;
      text-transform: capitalize;
      color: #666 !important;

      &::after {
        content: ":";
      }
    }

    > .el-form-item__content {
      flex: 1;
      box-sizing: border-box;

      > .el-form-item {
        padding-right: 1.3rem;

        > .el-form-item__label {
          padding: 0;
          margin: -1.2rem 0 3px 5px;
          font-size: 0.9rem;
          line-height: 0.9rem;
        }

        > .el-form-item__label + .el-form-item__content {
          margin-top: -1.2rem;
        }
      }
    }
  }

  .el-form-item .el-select {
    width: 100%;
  }
}

</style>
