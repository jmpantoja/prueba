import $predef from '~/plugins/atn/lang/en'
import genres from '~/lang/en/genres'
import movies from '~/lang/en/movies'
import directors from '~/lang/en/directors'

export default {
  ...$predef,
  menu: {
    dashboard: 'Dashboard',
    movies: 'Movies',
    genre: 'Genres',
    directors: 'Directors'
  },
  admin: {
    genres,
    movies,
    directors
  }
}
