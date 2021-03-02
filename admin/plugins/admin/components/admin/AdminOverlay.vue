<template>
  <v-dialog
    eager
    v-model="visible"
    :width="width"
    @click:outside="onClose"
    @keydown.esc="onClose"
  >
    <v-card :loading="loading">
      <v-card-title v-if="title">
        {{ title }}
      </v-card-title>
      <v-card-text>
        <slot name="content"/>
      </v-card-text>
      <v-card-actions>
        <slot name="actions:left"/>
        <v-spacer/>
        <slot name="actions:right"/>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "AdminOverlay",
  props: {
    width: {
      type: Number,
      default() {
        return 520
      }
    },
    value: {
      type: Boolean,
      default() {
        return false
      }
    },
    loading: {
      type: Boolean,
      default() {
        return false
      }
    },
    title: {
      type: String,
      default() {
        return false
      }
    }
  },

  computed: {
    visible: {
      get() {
        return this.value
      },
      set(visible) {
        this.$emit('input', visible)
      }
    }
  },
  methods: {
    onClose() {
      this.visible = false
    }
  }
}
</script>

<style scoped>

</style>
