import $predef from '~/plugins/atn/lang/es'

export default {
  ...$predef,
  menu: {
    dashboard: 'Escritorio',
    example: 'Ejemplo',
    contacts: 'Contactos',
    friends: 'Amigos',
  },
  admin: {
    contact: {
      title: 'Contactos',
      flash: {
        error: {
          404: 'Error 404'
        },
        success: {
          delete: 'Contacto eliminado correctamente',
          save: 'Contacto guardado correctamente'
        }
      },
      dialog: {
        delete: {
          title: 'Borrar contacto',
          message: '¿Esta seguro que desea borrar este contacto?<br/>Esta acción no podrá ser desecha'
        }
      },
      grid: {
        header: {
          id: '#',
          name: 'Nombre',
          birthDate: 'Fec. Nac',
        }
      },
      form: {
        title: {
          edit: 'editando',
          create: 'creando',
        },
        group: {
          personal: 'Personal',
          address: 'Dirección'
        },
        field: {
          fullName: 'Nombre',
          birthDate: 'Fec. Nac.',
          firstName: 'Nombre',
          lastName: 'Apellidos',
        }
      },
      button: {
        save: 'Guardar',
        delete: 'Borrar'
      }
    },
  }
}
