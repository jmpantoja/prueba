const admin = {
  title: 'Generos',
  flash: {
    error: {
      404: 'Error 404'
    },
    success: {
      delete: 'Genero eliminado correctamente',
      save: 'Genero guardado correctamente'
    }
  },
  dialog: {
    delete: {
      title: 'Borrar genero',
      message: '¿Esta seguro que desea borrar este elemento?<br/>Esta acción no podrá ser desecha'
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
    },
    field: {
      name: 'Nombre',
    }
  },
  button: {
    save: 'Guardar',
    delete: 'Borrar'
  }
}

export default admin
