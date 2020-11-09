<template>
  <v-container>
      <v-row>
        <v-col cols="6">
          <tag-list style="height: 200px" />
        </v-col>
        <v-col cols="6">
          <tag-list />
        </v-col>
      </v-row>
  </v-container>
</template>

<script>
import TagList from '~/components/admin/Tag/TagList'
export default {
  components: { TagList }
}
</script>
