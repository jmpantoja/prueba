import replace from "~/plugins/atn/lang/replace";
import defaults from "~/plugins/atn/lang/admin/es"

export default replace({
  extract(params) {
    const item = params.named('item') || {};
    item.name = item.name || {}
    return {
      item: `${item.name.lastName}, ${item.name.name}`,
      singular: 'director'
    }
  },
  defaults,
  messages: {
    title: 'Directores',
    flash: {
      success: {
        delete: 'El director "{item}" ha sido eliminado correctamente',
        save: 'El director "{item}" ha sido guardado correctamente'
      }
    },
    dialog: {
      delete: {
        title: 'Borrar director "{item}"',
      }
    },
    grid: {
      header: {
        id: '#',
        name: 'Nombre',
      }
    },
    form: {
      title: {
        edit: 'Editar director "{item}"',
        create: 'Nuevo {singular}',
      },
      group: {},
      field: {
        name: 'Nombre Completo',
      }
    }
  }
})
