<template>
  <div class="admin-filters">
    <v-navigation-drawer
      class="admin-filters-menu"
      mini-variant
      permanent
      absolute>
      <v-tooltip right color="primary" nudge-left="5" :open-delay="900">
        <template v-slot:activator="{ on, attrs }">
          <v-btn @click="onReset" icon v-on="on">
            <v-icon>mdi-refresh</v-icon>
          </v-btn>
        </template>
        <span>{{ $t('action.reset') }}</span>
      </v-tooltip>

      <v-tooltip right color="primary" nudge-left="5" :open-delay="900">
        <template v-slot:activator="{ on, attrs }">
          <v-btn @click="visible = !visible" icon v-on="on">
            <v-icon>mdi-magnify</v-icon>
          </v-btn>
        </template>
        <span>{{ $t('action.filter') }}</span>
      </v-tooltip>


    </v-navigation-drawer>
    <v-navigation-drawer class="admin-filters-drawer" v-model="visible" width="500px" absolute temporary>
      <v-form ref="form" style="height: 100%" lazy-validation onSubmit="return false;"
              @keyup.enter.native="onFilter">
        <v-card height="100%" class="d-flex flex-column">
          <v-card-text>
            <template v-for="(field, key) in grid.filterFields">
              <atn-field-wrapper :key="key" :field="field" v-model="item[key]"/>
            </template>

          </v-card-text>
          <v-spacer></v-spacer>
          <v-card-actions>
            <v-spacer/>
            <v-btn color="primary" text @click="onReset">
              {{ $t('action.reset') }}
            </v-btn>
            <v-btn color="primary" text @click="onFilter">
              {{ $t('action.filter') }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-navigation-drawer>
  </div>
</template>

<script>
import {Grid} from "../src";
import AtnFieldWrapper from "./AtnFieldWrapper";

export default {
  name: "AtnAdminFilters",
  components: {AtnFieldWrapper},
  props: {
    grid: {
      type: Grid,
      required: true
    },
  },
  data() {
    return {
      visible: false,
      item: this.grid.filtersDefault,
//      default: null
    }
  },
//   watch: {
//     item: {
//       handler(value) {
//         if (!this.default) {
//           this.default = _.cloneDeep(value)
//           this.grid.reload()
// //          this.onReset()
//         }
//       },
//       deep: true
//     }
//   },
  methods: {
    onFilter() {
      this.grid.filters = this.item
      this.visible = false
    },
    onReset() {
      this.grid.reset()
      this.visible = false
    },
  },

}
</script>

<style lang="scss" scoped>

.admin-filters {
  background-color: pink;

  ::v-deep .v-overlay {
    margin-left: 56px;
    box-shadow: none;
  }

  .admin-filters-menu {
    text-align: center;
    padding-top: 1em;
  }

  .admin-filters-drawer {
    margin-left: 56px;
    box-shadow: none;
  }
}
</style>
