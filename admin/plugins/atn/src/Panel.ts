import {Auth} from "@nuxtjs/auth-next";
import {FullScreen, Locale, MenuGroup, User} from "~/plugins/atn/src/index";
import {Location} from "vue-router";
import RolesManager from "~/plugins/atn/src/RolesManager";

const url = require('url');
const _ = require('lodash');

type Options = {
  menu: MenuGroup[],
  auth: Auth,
  locale: Locale,
  security: RolesManager
}

class Panel {
  private _drawer: boolean = true
  private readonly _menu: MenuGroup[];
  private readonly _fullScreen: FullScreen;
  private readonly _auth: Auth;
  private readonly _locale: Locale;
  private readonly _security: RolesManager;
  private _user: User;

  public constructor(options: Options) {
    this._menu = options.menu
    this._fullScreen = new FullScreen(window.document)
    this._auth = options.auth
    this._locale = options.locale
    this._security = options.security
    this._user = this.makeUser(options)
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

  private menuPath(href?: Location): string | null {
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

  public isGranted(roles: string[], user?: User) {
    user = user || this._user
    return this._security.isGranted(roles, user)
  }


  private makeUser(options: Options): User {
    return {
      name: _.get(options.auth, 'user.name'),
      email: _.get(options.auth, 'user.email'),
      roles: _.get(options.auth, 'user.roles'),
    };
  }
}

export default Panel
