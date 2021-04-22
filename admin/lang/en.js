import $predef from '~/plugins/atn/lang/en'
import genres from '~/lang/en/genres'
import movies from '~/lang/en/movies'

export default {
  ...$predef,
  menu: {
    dashboard: 'Dashboard',
    movies: 'Movies',
    genre: 'Genres',
  },
  admin: {
    genres,
    movies
  }
}
