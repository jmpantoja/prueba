import $vuetify from 'vuetify/es5/locale/en'

export default {

  $vuetify,
  app: {
    title: 'App',
    list: 'List'
  },
  toolbar: {
    search: "Search",
    login: "Login",
    logout: "Logout",
    profile: "Profile"
  },
  form: {
    save: 'Save',
    cancel: 'Cancel',
  },
  admin: {
    example: {
      menu: 'Example',
      contact: {
        menu: 'Contact List',
        grid: {
          title: 'Contact List',
          headers: {
            fullName: 'Complete Name',
            birthDate: 'Birth Date',
            age: 'Age',
          }
        },
        form: {
          title: {
            create: 'Create Contact',
            edit: 'Edit Contact',
          },
          labels: {
            firstName: 'First Name',
            lastName: 'Last Name',
            birthDate: 'Birth Date',
          }
        }
      }
    },
  },
}
