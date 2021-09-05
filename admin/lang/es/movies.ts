import {AdminTranslation} from "~/types/lang";

const _ = require('lodash')

const toString = (director: any) => {
  return _.get(director, 'title', '')
}

const movies: AdminTranslation = {
  toolbar: {
    list: 'Películas',
    edit: (params) => {
      const entity = params.named('entity');
      return `Editar '${toString(entity)}'`
    },
    create: 'Nueva película',
    delete: (params) => {
      return `Borrar '${toString(params.named('entity'))}'`
    },
  },
  filters: {
    title: 'título'
  },
  columns: {
    id: '#',
    title: 'título'
  },
  form: {
    title: 'título',
    year: 'estreno',
    genres: 'géneros'
  },
  message: {
    delete_confirmation: (params) => {
      const entity = params.named('entity');
      return `Realmente desea borrar la película <strong>'${toString(entity)}'</strong>`
    }
  },
  flash: {
    save: (params) => {
      const entity = params.named('entity');
      return `La película <strong>'${toString(entity)}'</strong> se ha guardado correctamente`
    },
    delete: (params) => {
      const entity = params.named('entity');
      return `La película <strong>'${toString(entity)}'</strong> se ha borrado correctamente`
    },
    error: (params) => {
      const description = params.named('description');
      return `Se ha producido un error: <br/><br/> <strong>'${description}'</strong>`
    },
  }
}


export default movies
