<template>
  <div class="wrapper" :style="wrapperStyles">

    <div class="toc">
      <v-list flat>
        <v-list-item-group
          v-model="selected"
          color="primary"
        >
          <v-list-item
            v-for="(group, index) in form.groups"
            :key="index"
            :class="{invalid: errorBag[index]}">

            <v-list-item-content>
              <v-list-item-title @click="goTo(`#group-${index}`, $event)">
                {{ t(`form.group.${group.label}`) }}
              </v-list-item-title>
            </v-list-item-content>

          </v-list-item>
        </v-list-item-group>
      </v-list>
    </div>

    <div ref="area" class="area" @scroll="handleScroll">
      <atn-admin-form-group
        v-for="(group, index) in form.groups"
        ref="group"
        @update:error="onUpdateError(index, $event)"
        :key="index"
        :group="group"
        :id="'group-'+index"
        :item="form.item"
      />

    </div>
  </div>
</template>

<script>
export default {
  name: "AtnAdminFormWithGroups",
  inject: {
    namespace: {
      default: null
    },
  },
  props: {
    form: {
      type: Object,
      required: true
    }
  },
  data() {
    const height = this.form.height
    return {
      selected: 0,
      wrapperStyles: {
        maxHeight: `${height}px`,
      },
      errorBag: {}
    }
  },
  methods: {
    resetValidation() {
      this.$refs['group'].forEach((group) => {
        group.resetValidation()
      })

      this.$nextTick(() => {
        this.errorBag = {}
      })

    },

    handleScroll() {
      let current = null;
      this.form.groups.some((value, index) => {
        const group = window.document.getElementById(`group-${index}`)
        const rect = group.getBoundingClientRect()
        current = index;
        return rect.top >= 200
      })

      this.selected = current
    },

    onUpdateError(group, value) {
      this.$set(this.errorBag, group, value)
    },
    goTo(selector) {
      this.$vuetify.goTo(selector, {
        container: '.area',
        offset: -62,
      })
    },
  }
}
</script>

<style scoped lang="scss">
@import '~vuetify/src/styles/styles.sass';

.wrapper {
  display: flex;
  flex-direction: row;

  .toc {
    min-width: 200px;
    border-right: solid 1px #e0e0e0;

    .v-list-item.invalid {
      color: map-get($red, 'accent-2') !important
    }

    .v-list-item--active {
      border-left: solid;
      font-weight: 500;
    }
  }

  .area {
    flex: 1;
    background-color: #fafafa;
    padding: 0 1em;
    overflow-y: auto
  }
}


</style>
