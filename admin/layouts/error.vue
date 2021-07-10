<template>
  <div>
    <p>OOOOPPPPPPS. ERROR</p>

    {{ message }}
  </div>
</template>

<script lang="ts">

import {Component, Prop, Vue} from 'nuxt-property-decorator'

@Component({
  name: 'Error',
})
export default class extends Vue {
  @Prop({required: false, type: Object}) error: Object = {}

  public message = this.error
}

</script>
