import Vue from "vue";
import {Admin} from "~/types/admin";
import {Security} from "~/types/security";

Vue.directive('granted', {
  inserted: (el, bindings, vnode) => {
    const context = (vnode.context as unknown as { admin: Admin, $security: Security })
    const admin: Admin = context.admin
    const security = context.$security

    const roles = admin.rolesByName(bindings.arg as string, bindings.value)

    if (!security.isGranted(roles)) {
      el.parentNode && el.parentNode.removeChild(el)
    }
  }
})


Vue.directive('roles', {
  inserted: (el, bindings, vnode) => {
    const context = (vnode.context as unknown as { admin: Admin, $security: Security })
    const admin: Admin = context.admin
    const security = context.$security

    const roles = rolesByName(bindings.arg as string, bindings.value)

    if (!security.isGranted(roles)) {
      el.parentNode && el.parentNode.removeChild(el)
    }
  }
})


function rolesByName(...keys: (string | string[])[]): string[] {
  const roles: string[] = []

  keys
    .filter((key: string | string[]) => key)
    .forEach((key: string | string[]) => {
      const role = typeof key === "string" ? [key] : key
      roles.push(...role)
    })

  return roles
}
