import $vuetify from 'vuetify/es5/locale/es'

export default {
  $vuetify,
  app: {
    title: 'Prueba',
  },
  toolbar: {
    search: "Buscar",
    login: "Login",
    logout: "Logout",
    profile: "Perfil"
  },
  action: {
    save: 'Guardar',
    delete: 'Borrar',
    reset: 'Reset',
    filter: 'Filtrar',
  },
  dialog: {
    yes: 'Si',
    no: 'No'
  },
  filter: {
    equals: 'igual a',
    contains: 'contiene',
    begins: 'empieza por',
    ends: 'termina en'
  },
  rules: {
    date: 'No es una fecha correcta'
  },
}
