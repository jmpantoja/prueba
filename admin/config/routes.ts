import admin from "./admin";
import {NuxtRouteConfig} from "@nuxt/types/config/router";

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
          props: action.props || {},
          meta: {
            roles: action.roles,
            endpoint: `${process.env.API_ENDPOINT}${admin.endpoint}`,
            components: admin.components
          }
        })
      })
  })

export default routes
