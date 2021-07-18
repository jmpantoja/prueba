<template>
  <div class="admin">
    esto es el formurario
  </div>
</template>

<script lang="ts">

import {Component, mixins} from 'nuxt-property-decorator'
import Action from "~/mixins/Action";

@Component({
  name: 'Form',
})
export default class extends mixins(Action) {


}

</script>

<style scoped lang="scss">

</style>
