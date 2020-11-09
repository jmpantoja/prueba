<template>
  <v-app-bar
      color="primary"
      fixed
      dark
      app
  >
    <v-app-bar-nav-icon class="ms-2" @click="toggleDrawer()"/>
    <v-text-field
        flat
        solo-inverted
        prepend-icon="mdi-magnify"
        :label="$t('toolbar.search')"
        class="hidden-sm-and-down mx-5"
        hide-details
    />
    <v-spacer/>
    <v-btn class="mx-2" icon text @click="handleFullScreen()">
      <v-icon>mdi-fullscreen</v-icon>
    </v-btn>

    <v-menu :left="!$vuetify.rtl" offset-y :nudge-right="$vuetify.rtl ? -10 : 10" :nudge-bottom="5"
            transition="slide-y-transition">
      <template v-slot:activator="{ on }">
        <v-btn class="mx-2" icon large text v-on="on">
          <v-avatar size="30px">
            <v-icon>mdi-account</v-icon>
          </v-avatar>
        </v-btn>
      </template>
      <v-list class="pa-0">
        <v-list-item @click="() => {}">
          <v-list-item-action>
            <v-icon>mdi-account</v-icon>
          </v-list-item-action>
          <v-list-item-content>{{ $t('toolbar.profile') }}</v-list-item-content>
        </v-list-item>

        <v-list-item @click="logout">
          <v-list-item-action>
            <v-icon>mdi-logout</v-icon>
          </v-list-item-action>
          <v-list-item-content>{{ $t('toolbar.logout') }}</v-list-item-content>
        </v-list-item>
      </v-list>
    </v-menu>

    <v-menu :left="!$vuetify.rtl" offset-y :nudge-right="$vuetify.rtl ? -10 : 10" :nudge-bottom="5"
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
                     v-for="lang in $i18n.locales"
                     :key="lang.code"
                     :value="lang.code"
                     :input-value="(lang.code === $i18n.locale)"
                     @click="switchLanguage(lang)"
        >
          <v-list-item-action>
            <country-flag :country='lang.flag'/>
          </v-list-item-action>
          <v-list-item-content>
            <span>{{ lang.code | uppercase }}</span>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-menu>
  </v-app-bar>
</template>

<script>
import Util from '~/util'
import CountryFlag from 'vue-country-flag'

export default {
  name: 'AppToolbar',
  components: {
    CountryFlag
  },
  data() {
    return {
      items: [
        {
          icon: 'mdi-account',
          href: '#',
          title: 'Profile',
          click: (e) => {
          }
        },
        {
          icon: 'mdi-settings',
          href: '#',
          title: 'Settings',
          click: (e) => {
          }
        },
        {
          icon: 'mdi-fullscreen-exit',
          href: '#',
          title: 'Logout',
          click: (e) => {

          }
        }
      ]
    }
  },
  methods: {
    toggleDrawer() {
      this.$store.commit('toggleDrawer')
    },
    handleFullScreen() {
      Util.toggleFullScreen()
    },
    switchLanguage(lang) {
      const newLocale = lang.code
      const isRtl = lang.rtl ?? false

      this.$root.$i18n.setLocaleCookie(newLocale)
      this.$i18n.locale = newLocale
      this.$vuetify.lang.current = newLocale
      this.$vuetify.rtl = isRtl

      const newPath = this.switchLocalePath(newLocale)
      this.$router.push(newPath || '/' + this.$i18n.defaultLocale)
    },

    logout() {
      this.$router.push(this.localePath('login'))
    }
  }
}
</script>
