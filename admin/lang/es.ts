import {Translation} from "~/types/lang";

// @ts-ignore
import entry from "./es/entry.ts"


const spanish: Translation = {
  profile: {
    profile: 'Perfil',
    logout: 'Salir'
  },
  lang: {
    es: 'Español',
    en: 'Ingles',
  },
  fields: {
    placeholder: 'Selecciona',
  },
  filters: {
    equals: 'igual a',
    contains: 'contiene',
    begins: 'empieza por',
    ends: 'termina en',
  },
  buttons: {
    reset: 'Restaurar',
    filter: 'Filtrar',
    save: 'Guardar',
    back: 'Volver',
    yes_delete: '<strong>Sí,</strong> Borrar'
  },
  menu: {
    dashboard: 'Escritorio',
    vocabulary: 'Vocabulario',
    entries: 'Entradas',

  },
  admin: {
    entry
  }
}

export default spanish;
