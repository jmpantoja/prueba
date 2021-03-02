import $vuetify from 'vuetify/es5/locale/en'

export default {
  $vuetify,
  app: {
    title: 'Try It!',
  },
  toolbar: {
    search: "Search",
    login: "Login",
    logout: "Logout",
    profile: "Profile"
  },
  action: {
    save: 'Save',
    delete: 'Delete',
    reset: 'Reset',
    filter: 'Filter',
  },
  dialog: {
    yes: 'Yi',
    no: 'No',
    delete: {
      title: 'Delete confirmation',
      message: 'Do you really want to delete this record? <br/>This action cannot be undone'
    }
  },
  filter: {
    equals: 'equals to',
    contains: 'contains',
    begins: 'begins by',
    ends: 'ends by'
  },
  rules: {
    date: 'The date is wrong'
  },
}
