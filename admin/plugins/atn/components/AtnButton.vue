<template>

  <v-btn
    v-if="computedProps.visible"
    v-bind="computedProps"
    @click="onClick">
    <v-icon
      v-if="button.icon"
      :left="!button.props.icon"
      :small="!button.large"
      :large="button.large"
    >
      {{ button.icon }}
    </v-icon>
    <template v-if="button.text">
      {{ t(`button.${button.text}`) }}
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
  data() {
    return {
      visible: true
    }
  },
  computed: {
    namespace(){
      return this.button.namespace
    },
    computedProps() {
      let props = _.cloneDeep(this.button.props);

      props.visible = this.$actionManager.isGranted(this.button, this.params)
      props.disabled = this.$actionManager.disabled(this.button, this.params)

      return this.button.customize(props, this.params)
    }
  },
  methods: {
    onClick() {
      this.$actionManager.run(this.button.namespace, this.button.action, this.params)
    }
  }
}
</script>

<style scoped>

</style>
