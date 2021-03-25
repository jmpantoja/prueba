<template>

  <v-btn
    v-if="computedProps.visible"
    v-bind="computedProps"

    @click="onClick"
  >
    <v-icon
      v-if="button.icon"
      :left="!button.props.icon"
      :small="!button.large"
      :large="button.large"
    >
      {{ button.icon }}
    </v-icon>
    <template v-if="button.text">
      {{ trans(`button.${button.text}`) }}
    </template>
  </v-btn>

</template>

<script>
import {Button} from "../src";

export default {
  name: "AtnButton",
  props: {
    button: Button,
    params: {
      type: Object,
      default() {
        return {}
      }
    },
  },
  inject: ['trans', 'manager'],
  data() {
    return {
      visible: true
    }
  },
  computed: {
    computedProps() {

      let props = _.cloneDeep(this.button.props);
      props.visible = this.manager.granted(this.button.action, this.params)
      props.disabled = this.manager.disabled(this.button.action, this.params)

      return this.button.customize(props, this.params)
    }
  },
  methods: {
    onClick() {
      this.manager.run(this.button.action, this.params)
    }
  }
}
</script>

<style scoped>

</style>
