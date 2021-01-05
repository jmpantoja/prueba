<template>
  <section>
    <component :is="admin.crud"/>
  </section>
</template>

<script lang="ts">
import {defineComponent, useContext} from '@nuxtjs/composition-api'

export default defineComponent({
  name: 'Crud',

  setup: function () {
    const {$adminStack, route, error} = useContext()
    const name = route.value.params.crud

    if (!$adminStack.hasAdmin(name)) {
      error({statusCode: 404, message: "Esta página no está disponible"})
    }

    const admin = $adminStack.byName(name)
    return {
      admin: crud
    }
  }
})
</script>

<style scoped>

</style>
