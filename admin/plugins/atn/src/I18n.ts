import {AdminContext, I18nOptions} from "~/plugins/atn/src/index";
import {IVueI18n} from "vue-i18n";

class I18n {
  private _namespace: string;
  private _i18n: IVueI18n;

  constructor(context: AdminContext, options: I18nOptions) {
    this._i18n = context.i18n
    this._namespace = options.namespace.toLowerCase()
  }

  public get namespace(): string {
    return this._namespace;
  }

  public translate(key: string) {
    return this._i18n.t(`${this.namespace}.${key}`)
  }
}

export default I18n;
