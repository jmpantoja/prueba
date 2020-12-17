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
      <v-btn @click="grid.togglePanel()" icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

    </v-navigation-drawer>
    <v-navigation-drawer class="crud-grid-panel" v-model="grid.showPanel" width="500px" absolute temporary>
      <v-form ref="form" style="height: 100%" lazy-validation onSubmit="return false;"
              @keyup.enter.native="onFilter">
        <v-card height="100%" class="d-flex flex-column">

          <v-card-text>
            <slot name="filters" :filters="filters"/>
          </v-card-text>

          <v-spacer></v-spacer>
          <v-card-actions>
            <v-spacer/>
            <slot name="action_reset" :filters="filters">
              <v-btn color="primary" text @click="onReset()">
                {{ $t('panel.reset') }}
              </v-btn>
            </slot>
            <slot name="action_filter" :filters="filters">
              <v-btn color="primary" text @click="onFilter()">
                {{ $t('panel.filter') }}
              </v-btn>
            </slot>
          </v-card-actions>
        </v-card>
      </v-form>

    </v-navigation-drawer>
  </div>
</template>
<script lang="ts">
import {Grid} from "~/plugins/admin/types";
import {ref} from '@vue/composition-api';

const _ = require('lodash')

export default {
  name: 'CrudPanel',
  props: {
    grid: {
      type: Grid,
      required: true
    }
  },
  setup({grid}) {

    const form = ref({
      inputs: []
    })

    return {
      form,
      filters: ref({}),

      onReset() {
        const inputs = form.value.inputs || []
        inputs.forEach((input) => {
          _.result(input, 'default')
        })

        this.onFilter()
      },
      onFilter() {
        grid.filterBy(this.filters)
      },
    }
  }
}
</script>


<style lang="scss">
.grid-menu {

  .menu {
    text-align: center;
    padding-top: 1em;
  }

  .v-data-table {
    margin-left: 56px;
  }

  .crud-grid-panel {
    margin-left: 56px;
    box-shadow: none;
  }

  .v-overlay {
    margin-left: 56px;
    box-shadow: none;
  }
}

</style>
