<template>
  <component v-if="isForm" :is="admin.form" :id="id"/>
  <component v-else :is="admin.dataList"/>
</template>

<script>
export default {
  validate ({ params }) {
    const action = params.action ?? null
    return ['list', 'create'].includes(action)
  },
  computed: {
    id () {
      const params = this.$route.params
      return params.id
    },
    isForm () {
      const params = this.$route.params
      return params.action === 'create'
    }
  }
}
</script>
