<template>
  <div class="container">
    <h1 v-if="error.statusCode === 404">Page not found</h1>
    <h1 v-else>An error occurred</h1>

    {{ error }}

    <NuxtLink to="/">Home page</NuxtLink>
  </div>
</template>

<script lang="ts">
import {Component, Prop, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";
import {Entity} from "../../admin/types/api";

@Component({
  inheritAttrs: false,
  computed: mapGetters({
    'closed': 'aside/closed',
  })
})
export default class extends Vue {
  @Prop() error!: Object

}

</script>

<!--<script>-->
<!--export default {-->
<!--  props: ['error'],-->
<!--}-->
<!--</script>-->
