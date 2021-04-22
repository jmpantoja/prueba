import replace from "~/plugins/atn/lang/replace";
import defaults from "~/plugins/atn/lang/admin/en"

export default replace({
  extract(params) {
    const item = params.named('item') || {};
    return {
      item: item.name,
      singular: 'genre'
    }
  },
  defaults,
  messages: {
    title: 'Genres',
    flash: {
      success: {
        delete: 'The genre "{item}" has been deleted successfully',
        save: 'The genre "{item}" has been saved successfully'
      }
    },
    dialog: {
      delete: {
        title: 'Delete genre "{item}"',
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
        edit: 'Edit genre "{item}"',
        create: 'New {singular}',
      },
      group: {},
      field: {
        name: 'name',
      }
    }
  }
})
