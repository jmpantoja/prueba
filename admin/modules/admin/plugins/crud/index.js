import Dashboard from "~/modules/admin/pages/Dashboard";
import Hola from "~/modules/admin/components/Hola";

const config = eval(`config = <%= JSON.stringify(options, null, 2) %>`)

export default (context, inject) => {

  const router = context.app.router;
  router.addRoutes([
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard,
      props: {
        hola: Hola
      }
    }
  ])


  console.log(config, context.app.router)
//inject('crud', reactive(admin))
}


