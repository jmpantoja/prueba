<template>
    <div>
        <contact-form/>
        <contact-toolbar/>
        <contact-grid/>
    </div>
</template>

<script>

import ContactForm from "../../components/admin/Example/Contact/ContactForm";
import ContactGrid from "../../components/admin/Example/Contact/ContactGrid";

import config from "~/admin/contacts"
import ContactToolbar from "../../components/admin/Example/Contact/ContactToolbar";

export default {
    components: {ContactToolbar, ContactGrid, ContactForm},
    provide() {
        return this.$makeAdmin(config).provide
    }
}
</script>
