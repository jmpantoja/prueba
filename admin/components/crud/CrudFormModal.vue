<template>
    <v-dialog v-model="form.opened" :width="width">
        <v-card :loading="loading">
            <v-card-title v-if="title">
                {{ title }} - {{ mode }}
            </v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation onSubmit="return false;"
                        @keyup.enter.native="onEnter">
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
                        <v-btn :disabled="!valid" color="primary" text @click="onSave(item)">
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
    name: "CrudFormModal",
    inject: ['grid', 'form'],
    props: {
        title: {
            type: String,
            required: false
        },
        width: {
            type: Number,
            default: () => 700
        }
    },
    data() {
        return {
            loading: false,
            valid: true,
            mode: 'create'
        }
    },
    computed: {
        item() {
            this.mode = this.form.mode
            return this.form.item
        },
    },
    watch: {
        mode(value) {
            if (value !== 'create') return
            this.$refs.form.resetValidation()
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
            if (!this.$refs.form.validate()) {
                return
            }
            if (item.id) {
                this.update(item)
                return;
            }
            this.create(item)
        },
        update(item) {
            this.loading = true
            this.form.update(item).then((updated) => {
                this.loading = false
                this.form.close()
                this.grid.replace(item, updated)
            })
        },
        create(item) {
            this.loading = true
            this.form.create(item).then((updated) => {
                this.loading = false
                this.form.close()
            })
        }
    }
}
</script>

<style scoped>

</style>
