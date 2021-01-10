import $vuetify from 'vuetify/es5/locale/en'

export default {
  $vuetify,
  app: {
    title: 'Reharsal'
  },
  toolbar: {
    search: "Search",
    login: "Login",
    logout: "Logout",
    profile: "Profile"
  },
  rules: {
    date: 'The date is wrong'
  },
  form: {
    save: 'Save',
    cancel: 'Cancel',
  },
  dialog:{
    delete: {
      title: 'Delete Record',
      text: 'Do you really want to delete this record?'
    },
    yes: 'Yes',
    no: 'No',
  },
  filter: {
    equals: 'equals to',
    contains: 'contains',
    begins: 'begins by',
    ends: 'ends by'
  },
  panel: {
    reset: 'Reset',
    filter: 'Filter'
  },
  menu: {
    dashboard: 'Dashboard',
    example: 'Sample',
    contact: 'Contacts'
  }
}
