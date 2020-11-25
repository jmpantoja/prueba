<template>
    <v-snackbar v-model="show" :color="color" top right vertical  multi-line timeout="1500">
        <template slot="default">
            <v-icon x-large v-if="icon">{{ icon }}</v-icon>
            <span class="text-h6 ">{{ $t(title) }}</span>
            <p class="text-body-1">{{ message }}</p>
        </template>
        <template v-slot:action="{ attrs }">
            <v-btn text v-bind="attrs" @click="show = false">
                {{ $t('notifier.close') }}
            </v-btn>
        </template>
    </v-snackbar>
</template>

<script>
export default {
    name: 'AppToast',
    data() {
        return {
            show: false,
            icon: null,
            title: '',
            message: '',
            color: ''
        }
    },
    created() {
        this.$store.subscribe((mutation, state) => {
            if (mutation.type === 'snackbar/showMessage') {
                this.title = state.snackbar.title
                this.message = state.snackbar.detail
                this.color = state.snackbar.color
                this.icon = state.snackbar.icon
                this.show = true
            }
        })
    }
}
</script>
