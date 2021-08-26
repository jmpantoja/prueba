import {AdminTranslation} from "~/types/lang";
import {MessageContext} from "vue-i18n";

const _ = require('lodash')

const toString = (genre: any) => {
  return _.get(genre, 'name', '')
}
const genres: AdminTranslation = {
  toolbar: {
    list: 'Géneros',
    edit: (params: MessageContext) => {
      const entity = params.named('entity');
      return `Editar '${toString(entity)}'`
    },
    create: 'Nuevo género',
    delete: (params) => {
      return `Borrar '${toString(params.named('entity'))}'`
    },
  },
  filters: {
    genre: 'Género'
  },
  columns: {
    id: '#',
    genre: 'género'
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
    save: (params: MessageContext) => {
      const entity = params.named('entity');
      return `El género <strong>'${toString(entity)}'</strong> se ha guardado correctamente`
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

export default genres;
