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
  dialog: {
    delete: {
      title: 'Borrar Registro',
      text: '¿Realmente desea borrar este registro?',
      success: 'Registro borrado correctamente'
    },
    edit: {
      title: 'Editar Registro',
      success: 'Registro editado correctamente'
    },
    create: {
      title: 'Nuevo Registro',
      success: 'Registro creado correctamente'
    },
    yes: 'Si',
    no: 'No',
    save: 'Guardar',
    cancel: 'Cancelar',
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
