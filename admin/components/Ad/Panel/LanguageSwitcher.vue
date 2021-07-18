<template>
  <el-dropdown size="medium" type="primary" @command="change">

    <el-button type="primary" size="mini">
      <country-flag :country='current.flag'/>
      <i class="el-icon-arrow-down el-icon--left"></i>
    </el-button>

    <el-dropdown-menu
      v-for="(locale, index) in locales"
      :key="index"
      slot="dropdown">

      <el-dropdown-item :command="locale.code">

        <country-flag :country='locale.flag'/>
        {{ $t('lang.' + locale.code) }}

      </el-dropdown-item>
    </el-dropdown-menu>
  </el-dropdown>
</template>

<script lang="ts">
import CountryFlag from 'vue-country-flag'
import {Component, Vue} from 'nuxt-property-decorator'
import {LocaleObject} from "nuxt-i18n";

@Component({
  name: 'LanguageSwitcher',
  components: {
    CountryFlag
  }
})
export default class extends Vue {
  private get _locales(): LocaleObject[] {
    return this.$i18n.locales.map((locale: LocaleObject | string) => {
      return typeof locale === 'string' ? {code: locale} : locale
    })
  }

  get current(): LocaleObject {
    return this._locales.find((locale: LocaleObject) => {
      return locale.code === this.$i18n.locale
    }) || {code: this.$i18n.locale}
  }

  get locales(): string[] | LocaleObject[] {
    return this._locales.filter((locale: LocaleObject) => {
      return locale.code !== this.$i18n.locale
    })
  }

  change(locale: string) {
    const route = this.switchLocalePath(locale)
    this.$router.push(route)
  }
}
</script>

<style scoped lang="scss">
.el-button {
  font-size: 1.2em;

  ::v-deep & > span {
    display: flex;
    align-items: center;
  }
}

.el-dropdown-menu__item {
  display: flex;

  span.flag {
    margin-top: -5px;
    margin-right: -5px;
  }
}


</style>
