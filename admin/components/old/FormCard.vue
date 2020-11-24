<template>
    <v-card>
        <v-card-title>
            {{ title }} - {{ valid }}
        </v-card-title>

        <v-card-text>
            <v-form v-model="valid" lazy-validation>
                <slot/>
            </v-form>
        </v-card-text>

        <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn v-for="(action, key) in _actions" :key="key"
                   color="primary"
                   text
                   @click="exec(action.callback, action)"
                   :disabled="action.disable_on_invalid && !valid"
            >
                {{ $t(action.text) }}
            </v-btn>

        </v-card-actions>
    </v-card>

</template>
<script>
import _ from "lodash"

export default {
    name: 'form-card',
    props: {
        actions: {
            type: Object,
            default: () => {
            }
        },
        title: {
            type: String,
            required: true
        },
        width: {
            type: Number,
            default: () => 500
        }
    },
    data() {
        return {
            valid: true,
            model: true
        }
    },
    computed: {
        _actions() {
            const actions = {
                cancel: {
                    text: 'form.cancel',
                    callback: this.onCancel
                },
                save: {
                    text: 'form.save',
                    callback: this.onSave,
                    disable_on_invalid: true
                }
            }
            return _.merge(actions, this.actions)
        }
    },
    methods: {
        exec(callback, ...params) {
            if (typeof callback !== 'function') {
                return
            }
            callback.call(this, ...params)
        },
        onCancel() {
            this.$root.$emit('close-dialog')
        },
        onSave() {
            alert('save')
        },
    }

}
</script>
