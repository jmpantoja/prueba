const _ = require('lodash')

const toString = (genre) => {
  return _.get(genre, 'name', '...')
}
export default {
  toolbar: {
    list: 'Géneros',
    edit: (params) => {
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
  }
}
