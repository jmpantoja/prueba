import replace from "~/plugins/atn/lang/replace";
import defaults from "~/plugins/atn/lang/admin/en"

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
    title: 'Directors',
    flash: {
      success: {
        delete: 'The director "{item}" has been deleted successfully',
        save: 'The director "{item}" has been saved successfully'
      }
    },
    dialog: {
      delete: {
        title: 'Delete director "{item}"',
      }
    },
    grid: {
      header: {
        id: '#',
        name: 'Name',
      }
    },
    form: {
      title: {
        edit: 'Edit director "{item}"',
        create: 'New {singular}',
      },
      group: {},
      field: {
        name: 'name',
      }
    }
  }
})
