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
  form: {
    field: {
      fullName: {
        firstName: 'Nombre',
        lastName: 'Apellidos'
      }
    }
  },
  rules: {
    year(params) {
      const min = params.named('min')
      const max = params.named('max')

      if (min && max) {
        return `El año debe estar entre ${min} y ${max}`
      }
      if (min) {
        return `El año debe ser ${min} o posterior`
      }
      if (max) {
        return `El año debe ser ${max} o anterior`
      }


    },
    date: 'No es una fecha correcta'
  },
}
