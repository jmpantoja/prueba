<template>

  <admin-dialog
    v-model="form.visible"
    :title="form.title"
    :loading="form.loading"
    :width="form.width"
  >
    <template slot="content">
      <admin-form :form="form"/>

    </template>

    <template slot="actions:left">
      <v-btn
        v-for="(action, event) in form.actions.left"
        :key="event"
        text
        @click="onAction(event, form.item)"
        :color="action.color">
        {{ $t(action.label) }}
      </v-btn>
    </template>
    <template slot="actions:right">
      <v-btn
        v-for="(action, event) in form.actions.right"
        :key="event"
        text
        @click="onAction(event, form.item)"
        :color="action.color">
        {{ $t(action.label) }}
      </v-btn>
    </template>
  </admin-dialog>
</template>

<script>
import {eventBus, Form} from "~/plugins/admin/src/admin";
import AdminDialog from "~/plugins/admin/components/admin/AdminDialog.vue";
import AdminForm from "~/plugins/admin/components/admin/AdminForm.vue";

export default {
  name: "AdminDialogForm",
  components: {AdminForm, AdminDialog},
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
  methods: {
    onAction(event, record) {
      eventBus.$emit(event, record)
    }
  },
  created() {
    eventBus.$on('onEdit', (record) => {
      this.form.load(record)
    })

    eventBus.$on('onSave', (record) => {
      this.form.save(record)
    })
  }

}
</script>

<style scoped>

</style>
