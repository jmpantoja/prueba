<template>
  <ad-action item plain v-slot="{entity, components}">
    <component :is="components.form" :entity="entity"/>
  </ad-action>

</template>

<script lang="ts">

import {Component, Vue} from 'nuxt-property-decorator'

@Component({
  name: 'Form',
})
export default class extends Vue {

}
</script>


