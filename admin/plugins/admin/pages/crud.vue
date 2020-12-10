<template>
  <section>
    <component :is="admin.grid"/>
  </section>
</template>

<script lang="ts">
import {defineComponent, useContext} from '@nuxtjs/composition-api'

export default defineComponent({
  name: 'Crud',
  setup() {
    const {route, $adminStack} = useContext()
    const admin = route.value.params.admin

    return {
      admin: $adminStack.byName(admin)
    }
  }
})
</script>

<style scoped>

</style>
