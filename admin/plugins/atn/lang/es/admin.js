const _ = require("lodash")

export default (data) => {

  const toString = (params) => {
    if (!params) {
      return ''
    }
    return data.stringfy(params)
  }

  const messages = {

  }



  const defaults = {
    flash: {
      error: {
        404: 'Error 404'
      },
      success: {
        delete: (params) => {
          const item = toString(params)
          return `El registro "${item}" ha sido eliminado con éxito`
        },
        save: (params) => {
          const item = toString(params)
          return `El registro "${item}" ha sido guardado con éxito`
        },
      }
    },
    dialog: {
      delete: {
        title(params) {
          const item = toString(params)
          return `Borrar "${item}"`
        },
        message: (params) => {
          const item = toString(params)
          return `¿Realmente desea borrar el registro "${item}"?<br/>Esta acción no podrá ser desecha`
        }
      }
    },
    form: {
      title: {
        edit: (params) => {
          const item = toString(params)
          const prefix = data.singular()
          return `Editar ${prefix} "${item}"`
        },
        create: (params) => {
          return `Nuevo`
        },
      }
    },
    button: {
      save: 'Guardar',
      delete: 'Borrar'
    }
  }

  return _.merge(defaults, data.admin)
}
