import $vuetify from 'vuetify/es5/locale/es'

export default {

  $vuetify,
  app: {
    title: 'App',
    list: 'Listado'
  },
  toolbar: {
    search: "Buscar",
    login: "Login",
    logout: "Logout",
    profile: "Perfil"
  },
  form: {
    save: 'Guardar',
    cancel: 'Cancelar',
  },
  notifier: {
    close: 'Cerrar',
    failed: 'Ha ocurrido un error:',
    deleted: 'Registro eliminado correctamente',
    updated: 'Registro actualizado correctamente',
  },
  modal: {
    delete: {
      title: '¿Confirma eliminar este registro?'
    },
    yes: 'Si, borrar',
    no: 'No',
  },
  rules: {
    required: 'Este campo es requerido',
    date: 'La fecha no es correcta'
  },
  admin: {
    example: {
      menu: 'Ejemplo',
      contact: {
        menu: 'Agenda',
        grid: {
          title: 'Agenda',
          headers: {
            fullName: 'Nombre Completo',
            birthDate: 'Fec. Nacimiento',
            age: 'Edad',
          }
        },
        form: {
          title: {
            create: 'Crear Contacto',
            edit: 'Editar Contacto',
          },
          labels: {
            firstName: 'Nombre',
            lastName: 'Apellido',
            birthDate: 'Fec. Nacimiento',
          }
        }
      }
    },
  },
}
