<template>
  <div class="form-dialog-wrapper">
    <el-button type="text" @click="click">{{ admin.message('buttons.create') }}</el-button>
    <el-dialog
      class="form-dialog"
      :title="admin.message('toolbar.create')"
      :visible.sync="visible">
      <component :is="admin.component('form')" :entity="{}"/>
    </el-dialog>

  </div>
</template>

<script lang="ts">
import {Component, mixins} from "nuxt-property-decorator";
import AdminAware from "~/mixins/AdminAware";
import Form from './Form.vue'
import {Entity} from "~/types/api";

@Component({
  name: "FormDialog",
  provide() {
    return {
      adDialog: this
    }
  }

})
export default class extends mixins(AdminAware) {

  public visible = false
  private form!: Form;

  public click() {
    this.visible = true

    if (this.form) {
      this.form.clearValidate()
    }
  }

  public setForm(form: Form) {
    this.form = form
    this.form.clearValidate()
    this.form.$on('save', (item: Entity) => {
      this.visible = false
      this.$emit('change', item)
    })

  }

}
</script>

<style scoped lang="scss">

$form-width: 40rem;

.form-dialog {

  ::v-deep {

    .el-dialog__header {
      background-color: $main-background-color;

      .el-dialog__title {
        color: $--color-primary;
        font-size: 2.5em;
        font-weight: 300;
      }
    }

    .el-dialog__body {
      padding: 1rem 0 0 0;
      background-color: $main-background-color;
    }


    .admin-form {
      max-height: calc(#{$panel-height} - 10vh);
      height: auto;

      .main {
        .form-wrapper {
          form {
            width: $form-width;
          }
        }
      }
    }
  }
}

</style>
