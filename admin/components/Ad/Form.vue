<template>
  <div class="admin-form">
    <div class="toc">
      <ul>
        <li v-for="(group, key) in groups"
            :key="key"
            @click="goTo(group)"
            :class="{active: active===group.name}">
          {{ group.title }}
        </li>
      </ul>
    </div>
    <div class="main">

      <div class="form-wrapper" @scroll="scroll($event)">
        <el-form
          ref="form"
          :model="model"
          label-position="left"
          label-width="9rem"
          v-loading="loading"

        >
          <slot name="fields" :model="model"/>
        </el-form>
      </div>
      <div class="footer">
        <el-button type="primary" @click="submit">{{ $t('buttons.save') }}</el-button>
      </div>
    </div>

  </div>
</template>

<script lang="ts">
import {Component, Inject, Prop, Vue, Watch} from 'nuxt-property-decorator'
import {Admin} from "~/types/admin";
import {FormGroupDefinition} from "~/types/form";

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
  @Prop({required: true, type: Object}) model!: object

  public loading = true
  public groups: { [key: string]: FormGroupDefinition } = {}
  public active?: string = null

  @Watch('model')
  updateModel() {
    this.loading = !!!this.model
  }

  public addGroup(group: FormGroupDefinition) {
    if (!this.active) {
      this.active = group.name
    }
    this.$set(this.groups, group.name, group)
  }


  private goTo(group: FormGroupDefinition) {
    this.active = group.name
    var wrapper = this.$el.querySelector(".form-wrapper");

    wrapper.scroll({
      top: group.position,
      behavior: 'smooth'
    })

  }

  private submit() {
    console.log(this.model)
  }

  private scroll(event) {
    var position = this.$el.querySelector(".form-wrapper").scrollTop;

    const group = Object.values(this.groups)
      .reduce((carry: { name: string, diff: number }, current: FormGroupDefinition) => {
        const diff = Math.abs(position - current.position)
        if (!carry) return {name: current.name, diff}

        if (diff <= carry.diff) {
          return {name: current.name, diff}
        }

        return carry

      }, null)

    this.active = group.name
  }
}
</script>

<style scoped lang="scss">

.admin-form {
  display: flex;
  flex-direction: row;

  height: $panel-height;
  box-sizing: border-box;

  .toc {
    min-width: 18rem;
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
      }

    }
  }

  .main {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    position: relative;

    .form-wrapper {

      padding: 2em 18rem 2em 2em;
      flex-grow: 1;
      overflow-y: auto;

    }

    .footer {
      position: absolute;
      text-align: right;
      padding: 1em;
      bottom: 0;
      right: 10px;
      left: 0;
      background: linear-gradient(180deg, hsla(0, 0%, 100%, .18) 0, hsla(0, 0%, 100%, .98) 87%, hsla(0, 0%, 100%, .98))
    }
  }
}

</style>
