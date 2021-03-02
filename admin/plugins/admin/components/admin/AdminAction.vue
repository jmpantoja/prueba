<template>
  <v-btn
    v-bind="action.props"
    @click="onClick"
    :disabled="disable"
    :icon="hasIcon"
  >
    <v-icon v-if="hasIcon" small>{{ icon }}</v-icon>
    <template v-else>{{ $t(label) }}</template>

  </v-btn>
</template>

<script>

import {Action} from "~/plugins/admin/src/admin";

export default {
  name: 'admin-action',
  inject: ['context', 'dispatcher'],
  props: {
    action: {
      type: Action
    },
    params: {
      type: Object
    }
  },
  data() {
    return {
      label: this.action.label,
      icon: this.action.icon
    }
  },
  methods: {
    onClick() {
      this.dispatcher.emit(this.action.name, this.params)
    }
  },
  computed: {
    hasIcon() {
      return !!this.icon
    },
    disable() {
      return !this.action.enabled(this.context, this.params)
    }
  }
}
</script>
