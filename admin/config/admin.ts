console.log(process.env)

export default {
  genres: {
    path: '/data/genres',
    endpoint: '/genres',
    components: {
      list: 'AppGenreList',
      form: 'AppGenreList',
      toolbar: 'AppGenreToolbar',
    },

    actions: {
      list: {
        component: '~/components/Ad/Action/List.vue',
        path: '/list',
        roles: ['USER'],
        props: {}
      },
      edit: {
        component: '~/components/Ad/Action/Form.vue',
        path: '/edit/:id',
        roles: ['EDITOR', 'USER'],
        props: {}
      },
      create: {
        component: '~/components/Ad/Action/Form.vue',
        path: '/create/',
        roles: ['EDITOR', 'USER'],
        props: {}
      }
    }
  }
}
