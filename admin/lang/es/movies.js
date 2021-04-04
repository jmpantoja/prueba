const admin = {
  title: 'Peliculas',
  flash: {
    error: {
      404: 'Error 404'
    },
    success: {
      delete: 'Película eliminada correctamente',
      save: 'Película guardada correctamente'
    }
  },
  dialog: {
    delete: {
      title: 'Borrar película',
      message: '¿Esta seguro que desea borrar este elemento?<br/>Esta acción no podrá ser desecha'
    }
  },
  grid: {
    header: {
      id: '#',
      title: 'Título',
      year: 'Estreno',
    }
  },
  form: {
    title: {
      edit: 'editando',
      create: 'creando',
    },
    group: {},
    field: {
      title: 'Título',
      year: 'Estreno',
      genres: 'Generos',
    }
  },
  button: {
    save: 'Guardar',
    delete: 'Borrar'
  }
}

export default admin
