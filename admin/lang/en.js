import $predef from '~/plugins/atn/lang/en'

export default {
  ...$predef,
  menu: {
    dashboard: 'Dashboard',
    example: 'Example',
    contacts: 'Contacts',
    friends: 'Friends',
  },
  admin: {
    contact: {
      title: 'Contacts',
      dialog: {
        delete: {
          title: 'Delete contact',
          message: 'Do you really want to delete this contact?<br/>This action cannot be undone'
        }
      },
      grid: {
        header: {
          id: '#',
          name: 'Name',
          birthDate: 'Birth Date',
        }
      },
      form: {
        title: {
          edit: 'editing',
          create: 'creating',
        },
        group: {
          personal: 'Personal Info',
          address: 'Address'
        },
        field: {
          fullName: 'Name',
          birthDate: 'Birth Date',
          firstName: 'First Name',
          lastName: 'Last Name',
        }
      },
      button: {
        save: 'Save',
        delete: 'Delete'
      }
    }
  }
}
