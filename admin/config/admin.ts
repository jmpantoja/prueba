import {AdminConfig} from "~/types/admin";


const entry: AdminConfig = {
  path: '/data/vocabulary/entries',
  endpoint: '/entries',
  components: {
    grid: 'AdminEntryGrid',
    form: 'AdminEntryForm',
    toolbar: 'AdminEntryToolbar',
  },
  actions: {
    list: {
      roles: ['read'],
      component: '~/components/Ad/Action/List.vue',
      path: '/list',
    },
    edit: {
      roles: ['update', 'read'],
      component: '~/components/Ad/Action/Form.vue',
      path: '/edit/:id',
    },
    delete: {
      roles: ['delete'],
      component: '~/components/Ad/Action/Delete.vue',
      path: '/delete/:id',
    },
    create: {
      roles: ['create'],
      component: '~/components/Ad/Action/Form.vue',
      path: '/create/',
    }
  }
}


export default {
  entry
}
