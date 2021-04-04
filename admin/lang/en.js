import $predef from '~/plugins/atn/lang/en'
import genre from '~/lang/en/genre'
import movie from '~/lang/en/movie'

export default {
  ...$predef,
  menu: {
    dashboard: 'Dashboard',
    movies: 'Movies',
    genre: 'Genres',
  },
  admin: {
    genre,
    movie
  }
}
