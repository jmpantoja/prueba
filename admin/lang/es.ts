import {Translation} from "~/types/lang";

// @ts-ignore
import genres from "./es/genres.ts"
// @ts-ignore
import directors from "./es/directors.ts"
// @ts-ignore
import movies from "./es/movies.ts"


const spanish: Translation = {
  profile: {
    profile: 'Perfil',
    logout: 'Salir'
  },
  lang: {
    es: 'Español',
    en: 'Ingles',
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
    yes_delete: '<strong>Sí,</strong> Volver'
  },
  menu: {
    film_archive: 'Filmoteca',
    dashboard: 'Escritorio',
    movies: 'Peliculas',
    borrame: 'Borrame',
    genres: 'Géneros',
    directors: 'Directores',
  },
  admin: {
    genres,
    directors,
    movies
  }
}

export default spanish;
