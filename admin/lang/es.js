import $predef from '~/plugins/atn/lang/es'
import genres from '~/lang/es/genres'
import movies from '~/lang/es/movies'
import directors from '~/lang/es/directors'


export default {
  ...$predef,
  menu: {
    dashboard: 'Escritorio',
    movies: 'Peliculas',
    genre: 'Generos',
    directors: 'Directores',
  },
  admin: {
    genres,
    movies,
    directors,
  }
}
