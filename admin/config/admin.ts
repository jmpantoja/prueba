import {AdminConfig} from "~/types/admin";


const entries: AdminConfig = {
  path: '/data/vocabulary/entries',
  endpoint: '/entries',
  components: {
    grid: 'AdminEntryGrid',
    form: 'AdminEntryForm',
    toolbar: 'AdminEntryToolbar',
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
  entries
}
