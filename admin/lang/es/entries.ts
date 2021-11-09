import {AdminTranslation} from "~/types/lang";

const _ = require('lodash')

const toString = (group: any) => {
  const term = _.get(group, 'term')
  if (term) {
    return `${term.term}`
  }
  return ''
}

const directors: AdminTranslation = {
  toolbar: {
    list: 'Entradas',
    edit: (params) => {
      const entity = params.named('entity');
      return `Editar '${toString(entity)}'`
    },
    create: 'Nuevo grupo',
    delete: (params) => {
      return `Borrar '${toString(params.named('entity'))}'`
    },
  },
  filters: {},
  columns: {
    id: '#',
    term: 'entradas'

  },
  form: {
    term: 'Palabra',
    meaning: 'Significado',
    lang: 'Idioma',
    type: 'Tipo',
    level: 'Nivel',
    audio: 'Audio',
    page: 'Pagina',
    option_spanish: 'Español',
    option_english: 'Ingles',
    option_word: 'Word',
    option_phrasal_verb: 'Phrasal Verb',
    option_collocation: 'Collocation',
  },
  buttons: {
    create: 'nueva entrada'
  },
  message: {
    delete_confirmation: (params) => {
      const entity = params.named('entity');
      return `Realmente desea borrar la entrada <strong>'${toString(entity)}'</strong>`
    }
  },
  flash: {
    save: (params) => {
      const entity = params.named('entity');
      return `La entrada <strong>'${toString(entity)}'</strong> se ha guardado correctamente`
    },
    delete: (params) => {
      const entity = params.named('entity');
      return `La entrada <strong>'${toString(entity)}'</strong> se ha borrado correctamente`
    },
    error: (params) => {
      const description = params.named('description');
      return `Se ha producido un error: <br/><br/> <strong>'${description}'</strong>`
    },
  }
}


export default directors
