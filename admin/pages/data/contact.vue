<template>
  <crud :crud="crud">
    <contact-form slot="form" :crud="crud"/>
    <contact-panel slot="panel" :crud="crud"/>
    <contact-grid slot="grid" :crud="crud"/>
  </crud>
</template>

<script lang="ts">
import {defineComponent, useContext} from "@nuxtjs/composition-api";
import ContactForm from "~/components/contact/ContactForm.vue";

export default defineComponent({
  components: {ContactForm},
  setup() {
    const {$adminStack} = useContext()
    const crud = $adminStack.byName('contact')

    return {
      crud: crud,
    }
  }
})
</script>
