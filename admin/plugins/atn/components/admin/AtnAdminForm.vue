<template>
  <atn-modal
    :title="t(form.title, {item: this.form.original} )"
    :width="form.width"
    :height="form.height"
    :loading="form.loading"
    :name="{'form-with-groups': !isSimple}"
    v-model="form.visible">

    <template v-slot:activator="{ on, attrs }">
      <slot name="activator" :on="on" :attrs="attrs"/>
    </template>

    <template slot="content">
      <v-form v-model="form.valid"
              ref="form"
              lazy-validation
              onSubmit="return false;"
              @keyup.enter.native="onEnter">
        <atn-field-wrapper
          v-if="isSimple"
          v-for="(field, name) in group.fields"
          v-model="form.item[field.key]"
          :namespace="form.namespace"
          :key="name"
          :field="field"/>

        <atn-admin-form-with-groups
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
import AtnFieldWrapper from "../field/AtnFieldWrapper";
import AtnAdminFormGroup from "./AtnAdminFormGroup";
import AtnAdminFormWithGroups from "./AtnAdminFormWithGroups";

export default {
  name: "AtnAdminForm",
  components: {AtnAdminFormWithGroups, AtnAdminFormGroup, AtnFieldWrapper, AtnAdmin, AtnButton, AtnModal},
  props: {
    form: {
      type: Form,
      required: true
    }
  },

  methods: {
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
  },
  updated() {
    this.form.valid = this.$refs['form'].validate()
  }

}
</script>

<style lang="scss">
@import '~vuetify/src/styles/styles.sass';

.form-with-groups {
  .modal-content {
    padding: 5px !important;
    overflow-y: hidden;

    .area {
      overflow-y: auto;
    }

    .v-list-item.invalid {
      color: map-get($red, 'accent-2')
    }

    .v-list-item--active {
      border-left: solid;
      font-weight: 500;
    }
  }
}

</style>

<style scoped lang="scss">

</style>
