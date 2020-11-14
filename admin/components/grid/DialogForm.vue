<template>
    <v-dialog v-model="active" :width="width">
        <v-card>
            <v-card-title>
                TITLE
            </v-card-title>

            <v-card-text>
                <v-form lazy-validation>
                    <slot/>
                </v-form>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn v-for="(action, key) in _actions" :key="key"
                       color="primary"
                       text
                       @click="exec(action.callback, action)"
                >
                    {{ $t(action.text) }}
                </v-btn>

            </v-card-actions>
        </v-card>
    </v-dialog>

</template>
<script>
import _ from "lodash"

export default {
    name: 'dialog-form',
    props: {
        value: {
            type: Boolean,
            required: true
        },
        width: false
    },
    computed: {
        active: {
            get() {
                return this.value
            },
            set(value) {
                this.$emit('input', value)
            }
        },
        _actions() {
            const actions = {
                cancel: {
                    text: 'form.cancel',
                    callback: this.onCancel
                },
                save: {
                    text: 'form.save',
                    callback: this.onSave
                }
            }
            return _.merge(actions, this.actions)
        }
    },
    methods:{
        exec(callback, ...params) {
            if (typeof callback !== 'function') {
                return
            }
            callback.call(this, ...params)
        },
        onCancel() {
            this.active = false
        },
        onSave() {
            alert('save')
        },
    }

}
</script>
