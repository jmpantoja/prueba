import {Context, NuxtError} from "@nuxt/types";
import {Auth} from "@nuxtjs/auth-next";

type NuxtErrorMethod = (params: NuxtError) => void;

class Security {
  private _context: Context;

  public constructor(context: Context) {
    this._context = context
  }

  private get auth(): Auth {
    return this._context.$auth
  }

  private get error(): NuxtErrorMethod {
    return this._context.error
  }


  public isGranted(roles?: string[]) {
    roles = roles || []
    if (roles.length === 0) {
      return true
    }

    return roles.some((role: string) => {
      return this.auth.hasScope(role.toUpperCase())
    })
  }

  public isDeny(roles?: string[]) {
    return !this.isGranted(roles)
  }

  public assert(roles?: string[]) {
    if (this.isDeny(roles)) {

      this.error({
        message: 'No puedes pasar',
        statusCode: 403
      })
    }
  }
}

export {Security}

export default (context: Context, inject: Function) => {

  const security = new Security(context);

  context.security = security
  inject('security', security)

}
