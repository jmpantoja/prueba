<template>
  <v-app-bar
    color="primary"
    fixed
    dark
    app
  >
    <v-app-bar-nav-icon class="ms-2" @click="drawer.toggle()"/>

    <v-text-field
      flat
      solo-inverted
      prepend-icon="mdi-magnify"
      :label="$t('toolbar.search')"
      class="hidden-sm-and-down mx-5"
      hide-details
    />
    <v-spacer/>
    <v-btn class="mx-2" icon text @click="fullScreen.toggle()">
      <v-icon>mdi-fullscreen</v-icon>
    </v-btn>

    <v-menu :left="true" offset-y :nudge-bottom="5"
            transition="slide-y-transition">
      <template v-slot:activator="{ on }">
        <v-btn class="mx-2" icon large text v-on="on">
          <v-avatar size="30px">
            <v-icon>mdi-account</v-icon>
          </v-avatar>
        </v-btn>
      </template>
      <v-list class="pa-0">
        <v-list-item @click="profile.profile()">
          <v-list-item-action>
            <v-icon>mdi-account</v-icon>
          </v-list-item-action>
          <v-list-item-content>{{ $t('toolbar.profile') }}</v-list-item-content>
        </v-list-item>

        <v-list-item @click="profile.logout()">
          <v-list-item-action>
            <v-icon>mdi-logout</v-icon>
          </v-list-item-action>
          <v-list-item-content>{{ $t('toolbar.logout') }}</v-list-item-content>
        </v-list-item>
      </v-list>
    </v-menu>

    <v-menu :left="true" offset-y :nudge-bottom="5"
            transition="slide-y-transition">

      <template v-slot:activator="{ on }">
        <v-btn class="mx-2" icon large text v-on="on">
          <v-avatar size="30px">
            <v-icon>mdi-translate</v-icon>
          </v-avatar>
        </v-btn>
      </template>

      <v-list class="pa-0">
        <v-list-item rel="noopener"
                     v-for="lang in locale.avaiables"
                     :key="lang.code"
                     :value="lang.code"
                     :input-value="(lang.code === locale.current)"
                     @click="locale.change(lang.code)"
        >
          <v-list-item-action>
            <country-flag :country='lang.flag'/>
          </v-list-item-action>
          <v-list-item-content>
            <span>{{ lang.code }}</span>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-menu>
  </v-app-bar>
</template>

<script>

import CountryFlag from 'vue-country-flag'

const url = require('url');

export default {
  name: 'UiToolbar',
  inject: ['drawer', 'fullScreen', 'locale', 'profile'],
  components: {
    CountryFlag
  }
}

</script>
