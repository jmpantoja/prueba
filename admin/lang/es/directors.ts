import {AdminTranslation} from "~/types/lang";

const _ = require('lodash')

const toString = (director: any) => {
  const name = _.get(director, 'name')
  if (name) {
    return `${name.name} ${name.lastName}`
  }
  return ''
}

const directors: AdminTranslation = {
  toolbar: {
    list: 'Directores',
    edit: (params) => {
      const entity = params.named('entity');
      return `Editar '${toString(entity)}'`
    },
    create: 'Nuevo director',
    delete: (params) => {
      return `Borrar '${toString(params.named('entity'))}'`
    },
  },
  filters: {
    name: 'Nombre'
  },
  columns: {
    id: '#',
    name: 'nombre'
  },
  form: {
    name: 'nombre'
  },
  message: {
    delete_confirmation: (params) => {
      const entity = params.named('entity');
      return `Realmente desea borrar el director <strong>'${toString(entity)}'</strong>`
    }
  },
  flash: {
    save: (params) => {
      const entity = params.named('entity');
      return `El director <strong>'${toString(entity)}'</strong> se ha guardado correctamente`
    },
    delete: (params) => {
      const entity = params.named('entity');
      return `El director <strong>'${toString(entity)}'</strong> se ha borrado correctamente`
    },
    error: (params) => {
      const description = params.named('description');
      return `Se ha producido un error: <br/><br/> <strong>'${description}'</strong>`
    },
  }
}


export default directors
