<template>
  <atn-modal
    :title="t(form.title, {item: this.form.original} )"
    :width="form.width"
    :height="form.height"
    :loading="form.loading"
    :name="{'form-with-groups': !isSimple}"
    @open="onOpen"
    v-model="form.visible">

    <template v-slot:activator="{ on, attrs }">
      <slot name="activator" :on="on" :attrs="attrs" :namespace="namespace"/>
    </template>

    <template slot="content">
      <v-form v-model="form.valid"
              ref="form"
              onSubmit="return false;"
              @keyup.enter.native="onEnter">

        <atn-field-wrapper
          v-if="isSimple"
          v-for="(field, name) in group.fields"
          v-model="form.item[field.key]"
          :key="name"
          :label="field.label"
          :type="field.type"
          :multiple="field.multiple"
          :props="field.props"
        />

        <atn-admin-form-with-groups
          ref="groups"
          v-if="!isSimple"
          :form="form"/>

      </v-form>
    </template>

    <template slot="actions:left">
      <atn-button
        v-for="(button, name) in form.buttons"
        v-if="button.slot === 'left'"
        :key="name"
        :params="{item: form.item}"
        :button="button"/>
    </template>

    <template slot="actions:right">
      <atn-button
        v-for="(button, name) in form.buttons"
        v-if="button.slot === 'default'"
        :ref="'button-'+name"
        :key="name"
        :params="{item: form.item}"
        :button="button"/>
    </template>

  </atn-modal>
</template>

<script>
import AtnModal from "./AtnModal";
import {Form} from "../../src";
import AtnAdmin from "./AtnAdmin";
import AtnButton from "./AtnButton";
import AtnAdminFormGroup from "./AtnAdminFormGroup";
import AtnAdminFormWithGroups from "./AtnAdminFormWithGroups";
import AtnFieldWrapper from "@/plugins/atn/components/form/AtnFieldWrapper";

export default {
  name: "AtnAdminForm",
  components: {
    AtnFieldWrapper, AtnAdminFormWithGroups, AtnAdminFormGroup, AtnAdmin, AtnButton, AtnModal
  },
  props: {
    form: {
      type: Form,
      required: true
    }
  },
  provide() {
    return {
      namespace: this.namespace
    }
  },
  data() {
    return {
      valid: false
    }
  },
  methods: {
    onOpen() {
      this.$refs['form'].resetValidation()
      if (this.$refs['groups']) {
        this.$refs['groups'].resetValidation()
      }
    },
    onEnter() {
      this.$actionManager.run(this.form.namespace, 'save', {item: this.form.item})
    }
  },
  computed: {
    namespace() {
      return this.form.namespace
    },
    isSimple() {
      return this.form.groups.length === 1
    },
    group() {
      return this.form.groups[0]
    }
  }
}
</script>

<style scoped lang="scss">

</style>
