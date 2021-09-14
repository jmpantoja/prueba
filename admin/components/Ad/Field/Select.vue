<template>
  <div class="ad-select-wrapper">

    <el-select
      ref="select"
      v-model="data"
      :prop="prop"
      :loading="admin.loading"
      v-bind="computedProps">

      <el-option
        v-for="item in options"
        :key="item.id"
        :label="normalize(item)"
        :value="item"/>
    </el-select>

    <ad-form-dialog @change="onDialogChange"/>

  </div>
</template>

<script lang="ts">

import Field from "~/mixins/Field";
import {Component, mixins, Prop, Watch} from 'nuxt-property-decorator'
import AdminAware from "~/mixins/AdminAware";
import {normalizeQuery} from "~/src/Grid";
import {Entity} from "~/types/api";

const Select = require('element-ui/lib/select').default
const _ = require('lodash')


type SelectProps = {
  multiple: boolean,
  remote: boolean
}

@Component({
  name: 'Select',
  props: {
    ...Select.props,
  },
  inject: {
    elFormItem: {
      default: ''
    }
  },
})
export default class extends mixins(Field, AdminAware) {
  @Prop({required: true, type: Function}) readonly normalize!: (item: object) => { id: string, label: string };

  @Prop({required: false, type: Function}) readonly remoteQuery!: (input: string) => object;
  @Prop({required: false, type: Boolean, default: () => true}) readonly filterable!: boolean;
  @Prop({required: false, type: String, default: () => 'id'}) readonly valueKey!: string;

  public options: Array<{}> = [];

  @Watch('value', {'deep': true, immediate: false})
  public refresh(value: object, old: object) {

    if (_.isEqual(value, old) || !this.computedProps.remote) {
      return
    }

    let options = [this.value as unknown as object]
    if (this.computedProps.multiple) {
      options = this.value || []
    }

    this.options = options
    this.$nextTick(() => {
      this.options = []
    })

  }

  public created() {
    this.refresh(this.data, []);
  }

  public async fetch() {
    const remote = (this.remoteQuery as any) instanceof Function;

    if (remote) {
      return
    }

    await this.admin
      .get()
      .then((response) => {
        this.options = response['items']
      })
  }


  public get computedProps(): SelectProps {
    const multiple = (this.value as any) instanceof Array;
    const remote = (this.remoteQuery as any) instanceof Function;

    const override = {
      multiple,
      remote,
      remoteMethod: remote ? this.search : undefined
    }

    return this.override(Select.props, override)
  }

  private async search(input: string) {

    if (input.length < 3) {
      this.options = []
      return
    }

    const query = normalizeQuery(this.remoteQuery(input))

    await this.admin
      .get(query)
      .then((response) => {
        this.options = response['items']
      })
  }

  public onDialogChange(entity: Entity) {
    if (this.computedProps.multiple) {
      this.data.push(entity)
      return
    }

    this.data = entity
  }

}
</script>


<style scoped lang="scss">
.ad-select-wrapper {
  width: 100%;


  .el-select {
    width: 100%;
  }
}


</style>
