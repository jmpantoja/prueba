<template>
    <div>
        <contact-form/>
        <contact-grid/>
    </div>
</template>

<script>

import ContactForm from "../../components/admin/Example/Contact/ContactForm";
import ContactGrid from "../../components/admin/Example/Contact/ContactGrid";

import config from "~/admin/contacts"

export default {
    components: {ContactGrid, ContactForm},
    provide() {
        return this.$makeAdmin(config).provide
    }
}
</script>
