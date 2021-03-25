<template>
  <v-dialog
    eager
    scrollable
    v-model="visible"
    :width="width"
    @click:outside="onClose"
    @keydown.esc="onClose"
  >
    <v-card :class="name" :loading="loading">
      <v-card-title class="card-title" v-if="title">
        {{ trans(title) }}
      </v-card-title>
      <v-divider style="margin-bottom: 2em"/>

      <v-card-text class="modal-content">
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
  name: "AtnModal",
  inject: ['trans'],
  props: {
    name: {
      type: String | Object,
      default() {
        return {}
      }
    },
    width: {
      type: Number,
      default() {
        return 520
      }
    },
    height: {
      type: Number,
      default() {
        return 400
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
      type: String | null,
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

<style scoped lang="scss">
.card-title {
  font-size: 1.8em !important;
  font-weight: 300;
  text-transform: capitalize;
  font-family: "Roboto";

}
</style>
