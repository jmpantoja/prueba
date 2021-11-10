import admin from "./admin";
import {NuxtRouteConfig} from "@nuxt/types/config/router";
import {ActionConfig} from "~/types/admin";

const routes: NuxtRouteConfig[] = []
Object.entries(admin)
  .forEach(([key, admin]) => {
    const prefix = `admin_${key}`
    const base = admin.path

    return Object.entries(admin.actions)
      .forEach(([name, action]) => {

        routes.push({
          name: `${prefix}_${name}`,
          path: `${base}${action.path}`,
          component: action.component,
          meta: {
            admin: key,
            action: name,
            roles: action.roles,
            components: admin.components,
          }
        })
      })
  })

export default routes
