import replace from "~/plugins/atn/lang/replace";
import defaults from "~/plugins/atn/lang/admin/es"

export default replace({
  extract(params) {
    const item = params.named('item') || {};
    return {
      item: item.name,
      singular: 'genero'
    }
  },
  defaults,
  messages: {
    title: 'Generos',
    flash: {
      success: {
        delete: 'El género "{item}" ha sido eliminado correctamente',
        save: 'El género "{item}" ha sido guardado correctamente'
      }
    },
    dialog: {
      delete: {
        title: 'Borrar género "{item}"',
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
        edit: 'Editar género "{item}"',
        create: 'Nuevo {singular}',
      },
      group: {},
      field: {
        name: 'Nombre',
      }
    }
  }
})
