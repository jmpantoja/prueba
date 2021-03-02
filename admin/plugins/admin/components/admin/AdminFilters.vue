<template>
  <div class="grid-menu">

    <v-navigation-drawer
      class="menu"
      mini-variant
      permanent
      absolute
    >
      <v-btn @click="onReset" icon>
        <v-icon>mdi-refresh</v-icon>
      </v-btn>
      <v-btn @click="visible = !visible" icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

    </v-navigation-drawer>
    <v-navigation-drawer class="crud-grid-panel" v-model="visible" width="500px" absolute temporary>
      <v-form ref="form" style="height: 100%" lazy-validation onSubmit="return false;"
              @keyup.enter.native="onFilter">
        <v-card height="100%" class="d-flex flex-column">
          <v-card-text>

            <template v-for="(field, index) in filters.fields">
              <v-wrapper :key="index" :field="field" v-model="item[field.name]"/>
            </template>

          </v-card-text>
          <v-spacer></v-spacer>
          <v-card-actions>
            <v-spacer/>
            <v-btn color="primary" text @click="onReset()">
              {{ $t('action.reset') }}
            </v-btn>
            <v-btn color="primary" text @click="onFilter()">
              {{ $t('action.filter') }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-navigation-drawer>
  </div>
</template>

<script>
import {FilterMapper, Grid} from "../../src/admin";
import VWrapper from "~/plugins/admin/components/form/VWrapper";


export default {
  name: "AdminFilters",
  components: {VWrapper},
  props: {
    grid: {
      type: Grid,
      required: true
    },
    filters: {
      type: FilterMapper,
      required: true
    }
  },
  data() {
    return {
      visible: false,
      item: this.filters.default
    }
  },
  methods: {
    onFilter() {
      this.grid.filters = this.item

    },
    onReset() {
      this.item = this.filters.default
      this.onFilter()
    },
  },


}
</script>

<style lang="scss" scoped>
.crud-grid {

  .v-data-table {
    margin-left: 56px;
  }

  .v-overlay {
    margin-left: 56px;
    box-shadow: none;
  }
}

.grid-menu {

  .menu {
    text-align: center;
    padding-top: 1em;
  }

  .crud-grid-panel {
    margin-left: 56px;
    box-shadow: none;
  }
}

</style>
