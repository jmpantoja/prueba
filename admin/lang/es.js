import genres from "./es/genres"
import directors from "./es/directors"

export default {
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
    save: 'Guardar'
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
    directors
  }
}
