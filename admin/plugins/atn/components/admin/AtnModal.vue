<template>
  <v-dialog
    eager
    scrollable
    v-model="visible"
    :width="width"
    @click:outside="onClose"
    @keydown.esc="onClose"
    @input="$emit('input', $event)"
  >
    <template v-slot:activator="{ on, attrs }">
      <slot name="activator" :on="on" :attrs="attrs"/>
    </template>

    <v-card :class="name" :loading="loading">
      <v-card-title class="card-title display-1" v-if="title">
        {{ title }}
      </v-card-title>
      <v-divider/>

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
  watch: {
    value(value) {
      if(value){
        this.$emit('open', value)
        return
      }
      this.$emit('close', value)
      return
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
  data() {
    return {
      //  visible: false
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
  font-weight: 300 !important;
  text-transform: capitalize;
}
</style>
