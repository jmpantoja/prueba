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
    no: 'No',
    delete: {
      title: 'Confirmación de borrado',
      message: '¿Realmente desea borrar este registro? <br/>Esta acción no podrá ser desecha'
    }
  },
  flash: {
    save: {
      success: 'Registro guardado correctamente',
      failure: 'No se pudo guardar el registro'
    },
    delete: {
      success: 'Registro borrado correctamente',
      failure: 'No se pudo borrar el registro'
    }
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
