import {Auth} from "@nuxtjs/auth-next";
import {RouteConfig} from "@nuxt/types/config/router";
import {FullScreen, Locale, MenuGroup} from "~/plugins/atn/src/index";

const url = require('url');

type Options = {
  menu: MenuGroup[],
  auth: Auth,
  locale: Locale
}

class Panel {
  private _drawer: boolean = true
  private readonly _menu: MenuGroup[];
  private _fullScreen: FullScreen;
  private _auth: Auth;
  private _locale: Locale;


  public constructor(options: Options) {
    this._menu = options.menu
    this._fullScreen = new FullScreen(window.document)
    this._auth = options.auth
    this._locale = options.locale
  }


  public toggle() {
    this._drawer = !this._drawer
  }

  public get drawer(): boolean {
    return this._drawer;
  }

  public set drawer(value: boolean) {
    this._drawer = value;
  }

  public get menu(): MenuGroup[] {
    return this._menu;
  }

  public breadcrumbs(path: string): object[] {
    const crumbs: object[] = []

    this.menu.forEach((group: MenuGroup) => {
      const menuPath = this.menuPath(group.href)
      if (menuPath === path) {
        crumbs.push({text: this._locale.translate(group.text)})
      }

      group.items?.forEach((item: MenuGroup) => {
        const menuPath = this.menuPath(item.href)
        if (menuPath === path) {
          crumbs.push({text: this._locale.translate(group.text)})
          crumbs.push({text: this._locale.translate(item.text)})
        }
      })
    })

    return crumbs
  }

  private menuPath(href: RouteConfig): string | null {
    const path = this._locale.url(href)

    if (path) {
      return url.parse(this._locale.url(href)).pathname
    }

    return null
  }

  public fullScreen() {
    this._fullScreen.toggle()
  }

  public logout() {
    this._auth.logout()
  }

  public profile() {
    alert('has pulsado en profile')
  }

  public changeLocale(locale: string) {
    this._locale.change(locale)
  }

  public get currentLocale() {
    return this._locale.current
  }

  public get locales() {
    return this._locale.avaiables
  }
}

export default Panel
