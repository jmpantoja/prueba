import {AdminConfig} from "~/types/admin";

const music_groups: AdminConfig = {
  path: '/data/music/groups',
  endpoint: '/music_groups',
  components: {
    grid: 'AdminGroupGrid',
    form: 'AdminGroupForm',
    toolbar: 'AdminGroupToolbar',
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

const albums: AdminConfig = {
  path: '/data/music/albums',
  endpoint: '/albums',
  components: {
    grid: 'AdminAlbumGrid',
    form: 'AdminAlbumForm',
    toolbar: 'AdminAlbumToolbar',
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
  music_groups,
  albums
}
