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
  dialog: {
    delete: {
      title: 'Delete Record',
      text: '¿Do you really want to delete this record?',
      success: 'Record deleted successfully'
    },
    edit: {
      title: 'Edit Record',
      success: 'Record edited successfully'
    },
    create: {
      title: 'New Record',
      success: 'Record created successfully'
    },
    yes: 'Yes',
    no: 'No',
    save: 'Save',
    cancel: 'Cancel',
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
