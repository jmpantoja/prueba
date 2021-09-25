import {AdminTranslation} from "~/types/lang";

const _ = require('lodash')

const toString = (group: any) => {
  const name = _.get(group, 'name')
  if (name) {
    return `${name}`
  }
  return ''
}

const directors: AdminTranslation = {
  toolbar: {
    list: 'Grupos',
    edit: (params) => {
      const entity = params.named('entity');
      return `Editar '${toString(entity)}'`
    },
    create: 'Nuevo grupo',
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
    name: 'nombre',
    country: 'Nacionalidad'
  },
  buttons: {
    create: 'nuevo grupo'
  },
  message: {
    delete_confirmation: (params) => {
      const entity = params.named('entity');
      return `Realmente desea borrar el grupo <strong>'${toString(entity)}'</strong>`
    }
  },
  flash: {
    save: (params) => {
      const entity = params.named('entity');
      return `El grupo <strong>'${toString(entity)}'</strong> se ha guardado correctamente`
    },
    delete: (params) => {
      const entity = params.named('entity');
      return `El grupo <strong>'${toString(entity)}'</strong> se ha borrado correctamente`
    },
    error: (params) => {
      const description = params.named('description');
      return `Se ha producido un error: <br/><br/> <strong>'${description}'</strong>`
    },
  }
}


export default directors
