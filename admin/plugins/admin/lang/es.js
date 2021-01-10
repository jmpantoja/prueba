import $vuetify from 'vuetify/es5/locale/es'

export default {
  $vuetify,
  app: {
    title: 'Prueba'
  },
  toolbar: {
    search: "Buscar",
    login: "Login",
    logout: "Logout",
    profile: "Perfil"
  },
  rules: {
    date: 'No es una fecha correcta'
  },
  form: {
    save: 'Guardar',
    cancel: 'Cancelar',
  },
  dialog:{
    delete: {
      title: 'Borrar Registro',
      text: '¿Realmente desea borrar este registro?'
    },
    yes: 'Si',
    no: 'No',
  },
  filter: {
    equals: 'igual a',
    contains: 'contiene',
    begins: 'empieza por',
    ends: 'termina en'
  },
  panel: {
    reset: 'Reset',
    filter: 'Filtrar'
  },
  menu: {
    dashboard: 'Escritorio',
    example: 'Ejemplo',
    contact: 'Contactos'
  }
}
