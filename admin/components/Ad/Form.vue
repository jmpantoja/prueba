<template>
  <div class="admin-form" :class="{'has-toc': hasToc}" v-loading="admin.loading">
    <div v-if="hasToc" class="toc">
      <ul>
        <li v-for="(group, key) in groups"
            :key="key"
            @click="goTo(group)"
            :class="{active: active===group.name, 'is-error': groupErrorBag[group.name] }">
          {{ group.title }}
        </li>
      </ul>
    </div>
    <div class="main">
      <div class="form-wrapper" @scroll="scroll($event)">

        <el-form
          ref="form"
          :model="model"
          @submit.native.prevent="submit"
          @validate="onValidate"
          validate-on-rule-change
          label-position="top"
          label-width="8rem">
          <slot name="fields" :model="model"/>
        </el-form>
      </div>
      <div class="footer">
        <el-button type="primary" :disabled="!valid" @click="submit">{{ $t('buttons.save') }}</el-button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import {Component, Inject, Prop, Vue, Watch} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";
import {FormGroupDefinition} from "~/types/form";
import {Entity} from "~/types/api";
import {Form} from "element-ui";

const _ = require("lodash")

type CarryGroup = { name: string, diff: number } | null;

@Component({
  name: 'Form',
  provide() {
    return {
      adForm: this
    }
  }
})
export default class extends Vue {
  @Inject('admin') private admin!: Admin
  @Prop({required: true, type: Object as () => Entity}) entity!: Entity
  @Prop({required: false, type: Object as () => Entity}) empty!: Entity

  private model: Entity = {id: null}
  private valid: boolean = true
  public groups: { [key: string]: FormGroupDefinition } = {}
  public active: string = ''
  private errorBag = {}
  private groupErrorBag: object = {};
  private hasToc!: boolean = false;


  @Watch('errorBag', {deep: true})
  updateError(val: object) {
    this.valid = !Object.values(val).includes(false)
  }

  @Watch('entity', {deep: true})
  updateEntity(val: object) {
    this.model = {
      ...this.empty,
      ...this.entity
    }
  }


  public created() {
    this.model = {
      ...this.empty,
      ...this.entity
    }
  }

  public addGroup(group: FormGroupDefinition) {
    if (!this.active) {
      this.active = group.name
    }
    this.$set(this.groups, group.name, group)

    this.hasToc = Object.keys(this.groups).length > 1;
  }

  public validateGroup(group: string, valid: boolean) {
    this.$set(this.groupErrorBag, group, !valid)
  }

  private goTo(group: FormGroupDefinition) {
    this.active = group.name
    var wrapper = this.$el.querySelector(".form-wrapper") as Element;

    wrapper.scroll({
      top: group.position,
      behavior: 'smooth'
    })

  }

  public scrolling: boolean = false

  private scroll() {
    this.scrolling = true

    setTimeout(() => {
      if (this.scrolling === true) {
        this.scrolling = false
        return
      }

      var element = this.$el.querySelector(".form-wrapper") as Element;
      var position = element.scrollTop;

      const group = Object.values(this.groups)
        .reduce((carry: CarryGroup, current: FormGroupDefinition) => {
          const diff = Math.abs(position - current.position)
          if (!carry) return {name: current.name, diff}

          if (diff < carry.diff) {
            return {name: current.name, diff}
          }
          return carry
        }, null)

      this.active = (group?.name) as string

    }, 100)

  }

  public mounted() {
    const form = this.$refs['form'] as Form;
    form.validate()
    form.clearValidate()
  }

  private onValidate(prop: string, valid: boolean) {

    this.$set(this.errorBag, prop, valid)
    this.$emit('validate', prop, valid)
  }

  private submit() {
    const form = this.$refs['form'] as Form;

    form.validate((valid) => {
      if (valid) {
        this.save();
      }
    });

  }

  private save() {

    this.admin.view === 'edit'
      ? this.admin.save(this.model).then((aaa) => {
        console.log('edit', aaa)
      })
      : this.admin.create(this.model).then((aaa) => {
        console.log('create', aaa)
      })
  }
}
</script>

<style scoped lang="scss">

$toc-width: 20rem;

.admin-form {
  display: flex;
  flex-direction: row;

  height: $panel-height;
  box-sizing: border-box;

  .toc {
    overflow-y: auto;
    width: $toc-width;
    border-right: $--border-base;

    ul {
      padding: 0;
      margin: 2em;

      li {
        cursor: pointer;
        list-style: none;
        padding-bottom: 0.5em;
        margin-bottom: 1.2em;

        &.active {
          border-bottom: solid 1px $--color-primary;
          color: $--color-primary;
          font-weight: 500;
          margin-bottom: 1.8em;
        }

        &.is-error {
          color: $--color-danger;
          border-color: $--color-danger;
        }
      }
    }
  }

  .main {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    position: relative;

    .form-wrapper {
      flex-grow: 1;
      overflow-y: auto;
      //padding: 3em $toc-width 0;

      form {
        width: 55em;
        margin: auto;
      }
    }


    .footer {
      position: absolute;
      text-align: right;
      padding: 1em;
      bottom: 0;
      right: 10px;
      left: 0;
      background: linear-gradient(180deg, rgba($main-background-color, .18) 0, rgba($main-background-color, .98) 87%, rgba($main-background-color, .98))
    }
  }

  &.has-toc {
    .toc {

    }
  }
}

</style>
