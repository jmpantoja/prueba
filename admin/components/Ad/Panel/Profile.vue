<template>
  <el-dropdown size="medium" type="primary" @command="change">

    <el-button type="primary" size="mini">
      <span class="fas el-icon-fa-user"/>
      <i class="el-icon-arrow-down el-icon--right"/>
    </el-button>

    <el-dropdown-menu slot="dropdown">

      <el-dropdown-item command="/profile">
        <span class="fas el-icon-fa-user el-icon--left"/>
        {{ $t('profile.profile') }}
      </el-dropdown-item>

      <el-dropdown-item divided command="logout">
        <span class="fas el-icon-fa-sign-out-alt el-icon--left"/>
        {{ $t('profile.logout') }}
      </el-dropdown-item>


    </el-dropdown-menu>
  </el-dropdown>
</template>

<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapActions} from "vuex";


@Component({
  name: 'Profile',
  methods: mapActions({
    'logout': 'user/logout'
  })

})
export default class extends Vue {
  $router: any
  $auth: any
  logout: any;

  change(route: string) {
    if ('logout' === route) {
      this.logout()
      return
    }
    this.$router.push(route)
  }

}
</script>

<style scoped lang="scss">
.el-button {
  font-size: 1.2em;
}

</style>
