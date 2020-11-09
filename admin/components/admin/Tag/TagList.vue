<template>
  <grid
      :headers="headers"
      :items="items"
      :items-per-page="15"
      :actions="actions"
      :toolbar="toolbar"
  >
<!--    <template v-slot:header.fat="{header}">-->
<!--      GORDO ({{ header.text }})-->
<!--    </template>-->

<!--    <template v-slot:item.name="{item}">-->
<!--      {{ item.name | uppercase }}-->
<!--    </template>-->
  </grid>
</template>

<script>
import _ from 'lodash'
import Grid from '~/components/grid/Grid'

export default {
  name: 'TagList',
  components: { Grid },
  data () {
    return {
      headers: [
        {
          text: 'Dessert (100g serving)',
          align: 'start',
          filterable: true,
          value: 'name'
        },
        {
          text: 'Calories',
          value: 'calories'
        },
        {
          text: 'Fat (g)',
          value: 'fat'
        },
        {
          text: 'Carbs (g)',
          value: 'carbs'
        },
        {
          text: 'Protein (g)',
          value: 'protein'
        },
        {
          text: 'Iron (%)',
          value: 'iron'
        }
      ],
      actions: {},
      toolbar: {
        title: this.$t('tag')
      }
    }
  },
  computed: {
    items () {
      return _.range(1, 120).map(index => ({
        id: index,
        name: `Name ${index}`,
        calories: `Calories ${index}`,
        fat: `Fat ${index}`,
        carbs: `Carbs ${index}`,
        protein: `Protein ${index}`,
        iron: `Iron ${index}`
      }))
    }
  },
}
</script>
<style scoped>

</style>
