import {AdminConfig} from "~/types/admin";

const genres: AdminConfig = {
  path: '/data/genres',
  endpoint: '/genres',
  components: {
    grid: 'AppGenreGrid',
    form: 'AppGenreForm',
    toolbar: 'AppGenreToolbar',
  },
  actions: {
    list: {
      component: '~/components/Ad/Action/List.vue',
      path: '/list',
    },
    edit: {
      component: '~/components/Ad/Action/Form.vue',
      path: '/edit/:id',
    },
    delete: {
      component: '~/components/Ad/Action/Delete.vue',
      path: '/delete/:id',
    },
    create: {
      component: '~/components/Ad/Action/Form.vue',
      path: '/create/',
    }
  }
}

const directors: AdminConfig = {
  path: '/data/directors',
  endpoint: '/directors',
  components: {
    grid: 'AppDirectorGrid',
    form: 'AppDirectorForm',
    toolbar: 'AppDirectorToolbar',
  },
  actions: {
    list: {
      component: '~/components/Ad/Action/List.vue',
      path: '/list',
    },
    edit: {
      component: '~/components/Ad/Action/Form.vue',
      path: '/edit/:id',
    },
    delete: {
      component: '~/components/Ad/Action/Delete.vue',
      path: '/delete/:id',
    },
    create: {
      component: '~/components/Ad/Action/Form.vue',
      path: '/create/',
    }
  }
}

const movies: AdminConfig = {
  path: '/data/movies',
  endpoint: '/movies',
  components: {
    grid: 'AppMovieGrid',
    form: 'AppMovieForm',
    toolbar: 'AppMovieToolbar',
  },
  actions: {
    list: {
      component: '~/components/Ad/Action/List.vue',
      path: '/list',
    },
    edit: {
      component: '~/components/Ad/Action/Form.vue',
      path: '/edit/:id',
    },
    delete: {
      component: '~/components/Ad/Action/Delete.vue',
      path: '/delete/:id',
    },
    create: {
      component: '~/components/Ad/Action/Form.vue',
      path: '/create/',
    }
  }
}

export default {
  genres,
  directors,
  movies
}
