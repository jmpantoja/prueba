const _ = require('lodash')

const toString = (genre) => {
  return _.get(genre, 'name', '')
}
export default {
  toolbar: {
    list: 'Genres',
    edit: (params) => {
      const entity = params.named('entity');
      return `Edit '${toString(entity)}'`
    },
    create: 'new genre',
    delete: (params) => {
      return `Delete '${toString(params.named('entity'))}'`
    },
  },
  filters: {
    genre: 'genre'
  },
  columns: {
    id: '#',
    genre: 'genre'
  },
  form: {
    name: 'genre'
  },
  api: {
    save: (params) => {
      const entity = params.named('entity');
      return `The genre <strong>'${toString(entity)}'</strong> has been saved successfully`
    },
  }
}
