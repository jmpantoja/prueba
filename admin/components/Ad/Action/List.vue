<template>
  <ad-action v-slot="{components}">

    <component :is="components.grid" />
  </ad-action>
</template>

<script lang="ts">

import {Component, Vue} from 'nuxt-property-decorator'

@Component({
  name: 'List',
})
export default class extends Vue {

}
</script>
