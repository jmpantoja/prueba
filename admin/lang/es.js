import $predef from '~/plugins/admin/lang/es'

export default {
  ...$predef,
  menu: {
    dashboard: 'Escritorio',
    example: 'Ejemplo',
    contact: 'Contactos',
    friends: 'Amigos',
  },
  admin: {
    friends: {
      title: 'Amigos',
      form: {
        create: 'Nuevo Amigo',
        edit: 'Editar "{name}"'
      }
    }
  },
}
