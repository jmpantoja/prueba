<template>
    <v-dialog v-model="form.opened" :width="width">
        <v-card :loading="loading">
            <v-card-title>
                {{ form.mode === 'edit' ? $t('admin.example.contact.form.title.edit') : 'NO' }}
            </v-card-title>
            <v-card-text>
                <v-form lazy-validation onSubmit="return false;" @keyup.enter.native="onEnter">
                    <slot name="form" :item="item"/>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-spacer/>
                <slot name="actions" :item="item">
                    <slot name="cancel" :item="item">
                        <v-btn color="primary" text @click="onCancel(item)">
                            {{ $t('form.cancel') }}
                        </v-btn>
                    </slot>
                    <slot name="save" :item="item">
                        <v-btn color="primary" text @click="onSave(item)">
                            {{ $t('form.save') }}
                        </v-btn>
                    </slot>
                </slot>
            </v-card-actions>
        </v-card>
    </v-dialog>

</template>

<script>
export default {
    name: "FormDialog",
    inject: ['grid', 'form'],
    props: {
        width: {
            type: Number,
            default: () => 700
        }
    },
    data() {
        return {
            loading: false,
        }
    },
    computed: {
        item() {
            return this.form.item
        }
    },
    methods: {
        onCancel() {
            this.form.close()
        },
        onEnter() {
            this.onSave(this.item)
        },
        onSave(item) {
            this.loading = true
            this.form.update(item).then((updated) => {
                this.loading = false
                this.form.close()
                this.grid.replace(item, updated)
            })
        }
    }
}
</script>

<style scoped>

</style>
