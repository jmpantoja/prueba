<template>
  <v-row justify="space-around">
    <v-col md="4">
      <div
        class="d-flex flex-column align-center justify-center"
      >
        <v-form @submit.prevent="login">
          <v-card class="elevation-4 pa-3">
            <v-card-text>

              <div class="d-flex flex-column align-center">
                <img src="~/static/logo.svg" alt="Vue Material Admin" width="120" height="120">
                <h1 class="my-4 primary--text">
                  {{ $t('app.title') }}
                </h1>
              </div>

              <v-text-field
                v-model="email"
                prepend-icon="mdi-account"
                name="login"
                label="Email"
                type="text"/>

              <v-text-field
                id="password"
                v-model="password"
                prepend-icon="mdi-lock"
                name="password"
                label="Password"
                type="password"
              />

            </v-card-text>

            <v-card-actions>
              <v-btn block color="primary" :loading="loading" @click="login">
                Login
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-form>


      </div>
    </v-col>
  </v-row>

</template>

<script>
export default {
  auth: 'guest',
  layout: 'empty',

  data() {
    return {
      email: '',
      password: '',
      loading: false
    }
  },

  methods: {
    async login() {
      this.error = null
      this.loading = true

      return this.$auth
        .loginWith('local', {
          data: {
            email: this.email,
            password: this.password
          }
        })
        .then((response) => {
          this.loading = false
          const dashboard = this.$auth.options.redirect.home
          this.$router.push(dashboard)
        })
        .catch((e) => {
          this.error = e.response.data
          this.loading = false
        })
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
