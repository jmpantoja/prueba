<template>
  <div class="wrapper">

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

    <div ref="area" class="area" :style="contentStyles" @scroll="handleScroll">
      <atn-admin-form-group
        v-for="(group, index) in form.groups"
        @update:error="onUpdateError(index, $event)"
        :key="index"
        :group="group"
        :id="'group-'+index"
        :namespace="namespace"
        :item="form.item"
      />

    </div>
  </div>

</template>

<script>
export default {
  name: "AtnAdminFormWithGroups",
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
      contentStyles: {
        maxHeight: `${height - 6}px`,
      },
      errorBag: {}
    }
  },
  methods: {
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
  },
  computed: {
    namespace() {
      return this.form.namespace
    }
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
  }

  .area {
    flex: 1;
    background-color: #fafafa;
    padding: 0 1em;

  }


  //.menu {
  //  display: block;
  //  background-color: yellow;
  //  border: solid 1px red;
  //}
  //
  //.area {
  //  background-color: #b1dfbb;
  //}
}


//
//.toc {
//  padding: 5px !important;
//  overflow-y: hidden;
//
//  .area {
//    overflow-y: auto;
//  }
//
//  .v-list-item.invalid {
//    color: map-get($red, 'accent-2')
//  }
//
//  .v-list-item--active {
//    border-left: solid;
//    font-weight: 500;
//  }
//
//}

</style>
