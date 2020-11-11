<template>
  <v-container>
      <v-row>
        <v-col cols="6">
          <borrame/>
        </v-col>
        <v-col cols="6">
          <tag-list />
        </v-col>
      </v-row>
  </v-container>
</template>

<script>
import TagList from '~/components/admin/Tag/TagList'
import Borrame from "../components/grid/Borrame";
export default {
  components: {Borrame, TagList }
}
</script>
