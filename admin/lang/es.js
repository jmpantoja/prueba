import $predef from '~/plugins/atn/lang/es'
import genre from '~/lang/es/genres'
import movies from '~/lang/es/movies'

export default {
  ...$predef,
  menu: {
    dashboard: 'Escritorio',
    movies: 'Peliculas',
    genre: 'Generos',
  },
  admin: {
    genre,
    movies
  }
}
