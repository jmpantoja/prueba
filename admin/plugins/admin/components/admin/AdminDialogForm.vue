<template>

  <admin-overlay
    v-model="form.visible"
    :title="title"
    :loading="form.loading"
    :width="form.width"
  >
    <template slot="content">
      <admin-form :form="form"/>
    </template>

    <template slot="actions:left">
      <admin-action
        v-for="(action, index) in form.actions"
        :key="index"
        v-if="action.props.slot === 'left'"
        :action="action"
        :params="{record: form.item}"/>
    </template>
    <template slot="actions:right">
      <admin-action
        v-for="(action, index) in form.actions"
        :key="index"
        v-if="action.props.slot === 'right'"
        :action="action"
        :params="{record: form.item}"/>

    </template>
  </admin-overlay>
</template>

<script>
import {Form} from "~/plugins/admin/src/admin";
import AdminOverlay from "~/plugins/admin/components/admin/AdminOverlay.vue";
import AdminForm from "~/plugins/admin/components/admin/AdminForm.vue";
import AdminAction from "./AdminAction";

export default {
  name: "AdminDialogForm",
  components: {AdminAction, AdminForm, AdminOverlay},
  inject: ['context'],
  props: {
    form: {
      type: Form,
      required: true
    }
  },
  data() {
    return {
      visible: false,
    }
  },
  computed: {
    title() {
      const name = this.context.toString(this.form.item);

      return this.$t(this.form.title, {name: name})
    }
  },
  methods: {
    onAction(action, record) {
      this.form.emit(action.name, {record})
    }
  }
}
</script>

