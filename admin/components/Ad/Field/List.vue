<template>
  <div class="field-list">
    <div class="field-list__row" v-for="(item, index) in value">
      <div class="col col_index">
        #{{ index + 1 }}
      </div>

      <div class="col col_form field-group">
        <slot :index="index" :item="item"/>
      </div>

      <div class="col col_actions">
        <el-button type="text"
                   class="btn_delete"
                   icon="el-icon-delete"
                   @click.native.prevent="removeRow(index)"/>
      </div>

    </div>

    <div class="field-list__footer">
      <el-button type="primary" icon="el-icon-plus" @click="$emit('add', data.length)" size="mini">
        Nuevo
      </el-button>
    </div>

  </div>
</template>

<script lang="ts">

import Field from "~/mixins/Field";
import {Component, mixins} from 'nuxt-property-decorator'

@Component({
  name: 'List',
})
export default class extends mixins(Field) {

  public removeRow(index: number) {
    this.value.splice(index, 1)
  }

}
</script>


<style scoped lang="scss">

.btn_delete {
  color: $--color-danger;
}

.field-list__row {
  display: flex;
  flex-direction: row;
  margin-bottom: 2rem;

  .col {
  //  border: solid 1px blue;
  }

  .col_index {
    flex-grow: 1;
    text-align: left;
    padding-top: 1.5rem;
  }

  .col_form {
    flex-grow: 10;
  }

  .col_actions {
    flex-grow: 2;
    text-align: left;
    padding-top: 1rem;
  }
}

.field-list__footer {
  display: flex;
  flex-direction: row;
  margin-bottom: 2rem;
  padding-right: 1rem;
  justify-content: flex-end;
}


</style>
