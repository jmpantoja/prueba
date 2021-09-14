<template>
  <ad-action item v-slot="{entity}">

    <ad-delete-confirmation :entity="entity" />

  </ad-action>
</template>

<script lang="ts">

import {Component, Vue} from 'nuxt-property-decorator'

@Component({
  name: 'Delete',
})
export default class extends Vue {

}

</script>


