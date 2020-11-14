import $vuetify from 'vuetify/es5/locale/es'

export default {

  $vuetify,
  app: {
    title: 'App',
    list: 'Listado'
  },
  toolbar: {
    search: "Buscar",
    login: "Login",
    logout: "Logout",
    profile: "Perfil"
  },
  admin: {
    example: {
      menu: 'Ejemplo',
      contact: {
        menu: 'Agenda',
        grid: {
          title: 'Agenda',
          headers: {
            fullName: 'Nombre Completo',
            birthDate: 'Fec. Nacimiento',
            age: 'Edad',
          }
        }
      }
    },
  },
}
