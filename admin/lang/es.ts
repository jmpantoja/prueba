import {Translation} from "~/types/lang";

// @ts-ignore
import music_groups from "./es/music_groups.ts"


const spanish: Translation = {
  profile: {
    profile: 'Perfil',
    logout: 'Salir'
  },
  lang: {
    es: 'Español',
    en: 'Ingles',
  },
  fields:{
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
    music_groups: 'Grupos',
    music: 'Música',
  },
  admin: {
    music_groups
  }
}

export default spanish;
