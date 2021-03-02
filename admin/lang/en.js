import $predef from '~/plugins/admin/lang/en'

export default {
  ...$predef,
  menu: {
    dashboard: 'Dashboard',
    example: 'Example',
    contact: 'Contacts',
    friends: 'Friends',
  },
  admin: {
    friends: {
      title: 'Friends',
      form: {
        create: 'Create Friend',
        edit: 'Edit "{name}"'
      }
    }
  },
}
