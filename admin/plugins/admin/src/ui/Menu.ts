import {MenuGroup} from "../../src/types/Config";
import {RouteConfig} from "@nuxt/types/config/router";
import Locale from "./Locale";

const url = require('url');

declare module '@nuxt/types' {
  interface Context {
    $menu: Menu
  }
}

class Menu {

  private locale: Locale;
  private _menu: MenuGroup[];

  constructor(locale: Locale, menu: MenuGroup[]) {
    this.locale = locale
    this._menu = menu;
  }

  get groups() {
    return this._menu
  }


  public breadcrumbs(path: string): object[] {
    const crumbs: object[] = []

    this.groups.forEach((group: MenuGroup) => {
      const menuPath = this.menuPath(group.href)
      if (menuPath === path) {
        crumbs.push({text: this.locale.translate(group.text)})
      }

      group.items?.forEach((item: MenuGroup) => {
        const menuPath = this.menuPath(item.href)
        if (menuPath === path) {
          crumbs.push({text: this.locale.translate(group.text)})
          crumbs.push({text: this.locale.translate(item.text)})
        }
      })
    })

    return crumbs
  }

  private menuPath(href: RouteConfig): string | null {
    const path = this.locale.url(href)

    if (path) {
      return url.parse(this.locale.url(href)).pathname
    }

    return null
  }


}

export default Menu;
