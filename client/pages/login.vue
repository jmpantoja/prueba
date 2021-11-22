<template>
  <div class="container">


    <el-card class="box-card">
      <el-form ref="loginForm"
               :model="model"
               :rules="loginRules"
               class="login-form"
               autocomplete="on"
               label-position="left">

        <div class="fas el-icon-fa-chess-knight logo"/>

        <span v-if="error" class="error">{{ error }}</span>
        <el-form-item prop="email">
          <el-input
            v-model="model.email"
            placeholder="email"
            prop="username or email"
            type="text"
            suffix-icon="fas el-icon-fa-user"
            tabindex="1"
            autocomplete="off"
          />
        </el-form-item>

        <el-form-item prop="password">
          <el-input
            v-model="model.password"
            placeholder="Password"
            :type="type"
            prop="password"
            tabindex="2"
            autocomplete="off"
            @keyup.enter.native="handleLogin"
          >
          <span slot="suffix"
                class="clickable fas"
                :class="{'el-icon-fa-eye': !visible, 'el-icon-fa-eye-slash': visible}"
                @click="toggle"/>
          </el-input>

        </el-form-item>

        <el-button :loading="loading" type="primary" style="width:100%;margin-bottom:30px;"
                   @click.native.prevent="handleLogin">Login
        </el-button>
      </el-form>

    </el-card>
  </div>
</template>

<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {ElForm} from "element-ui/types/form";

import  {AxiosError} from 'axios';

@Component({
  auth: false,
  layout: 'empty',
  name: 'Admin'
})
export default class Login extends Vue {

  error: string | null = null
  visible: boolean = false
  loading: boolean = false

  model: object = {
    email: null,
    password: null
  }

  loginRules: object = {
    email: [
      {
        required: true,
        trigger: 'blur',
        message: 'el email es requerido'
      }
    ],
    password: [
      {
        required: true,
        message: 'el password es requerido',
        trigger: 'blur'
      }
    ],
  }
  $router: any
  $auth: any


  get type() {
    return this.visible ? 'text' : 'password'
  }

  toggle() {
    this.visible = !this.visible
  }


  handleLogin() {
    const form = (this.$refs.loginForm as ElForm)

    form.validate((valid: boolean) => {

      if (!valid) {
        return false
      }

      this.loading = true
      return this.$auth
        .loginWith('local', {
          data: this.model
        })
        .then(() => {
          this.loading = false
          const dashboard = this.$auth.options.redirect.home
          this.$router.push(dashboard)
        })
        .catch((e: AxiosError) => {
          this.error = e.response!.data.message
          this.loading = false
        })

    })
  }
}

</script>

<style scoped lang="scss">

::v-deep .clickable:hover {
  cursor: pointer;
}

.container {
  display: flex;
  flex-direction: row;

  align-items: center;
  justify-content: center;

  height: 100vh;


  .login-form {

    .error {
      color: $--color-danger;
    }

    .logo {
      font-size: 10em;
      text-align: center;
      width: 100%;
      padding-bottom: 2rem;
    }
  }
}

</style>
