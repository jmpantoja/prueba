import replace from "~/plugins/atn/lang/replace";
import defaults from "~/plugins/atn/lang/admin/es"

export default replace({
  extract(params) {
    const item = params.named('item') || {};
    return {
      item: item.title,
      singular: 'película',
    }
  },
  defaults,
  messages: {
    title: 'Películas',
    flash: {
      success: {
        delete: 'La película "{item}" ha sido eliminada correctamente',
        save: 'La película "{item}" ha sido guardada correctamente'
      }
    },
    dialog: {
      delete: {
        title: 'Borrar película "{item}"',
      }
    },
    grid: {
      header: {
        title: 'Título',
        year: 'Año de estreno',
      }
    },
    form: {
      title: {
        edit: 'Editar película "{item}"',
        create: 'Nueva {singular}',
      },
      group: {
        default: 'General',
        genres: 'Generos'
      },
      field: {
        title: 'Título',
        year: 'Año de estreno',
        genres: 'Generos',
      }
    }
  }
})
