<template>
  <v-form ref="form"
          v-model="form.valid"
          lazy-validation
          onSubmit="return false;"
          @keyup.enter.native="onEnter()">

    <admin-form-row
      v-for="(row, index) in form.layout.rows"
      :key="index"
      :row="row"
      :item="form.item"
    />
    <admin-form-tabs
      v-if="hasTabs"
      :layout="form.layout"
      :item="form.item"/>
  </v-form>
</template>

<script>
import {Form} from "~/plugins/admin/src/admin";
import AdminFormRow from "~/plugins/admin/components/admin/AdminFormRow.vue";
import AdminFormTabs from "~/plugins/admin/components/admin/AdminFormTabs.vue";

export default {
  name: "AdminForm",
  components: {AdminFormRow, AdminFormTabs},
  inject: ['dispatcher'],
  props: {
    form: {
      type: Form,
      required: true
    }
  },
  data() {
    return {
      valid: true,
    }
  },
  computed: {
    hasTabs() {
      return this.form.layout.tabs.length > 0
    }
  },
  methods: {
    onEnter() {
      const record = this.form.item;
      this.dispatcher.emit('form.save', {record})
    }
  }
}
</script>

<style scoped>

</style>
