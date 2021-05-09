import replace from "~/plugins/atn/lang/replace";
import defaults from "~/plugins/atn/lang/admin/en"

export default replace({
  extract(params) {
    const item = params.named('item') || {};
    return {
      item: item.title,
      singular: 'movie'
    }
  },
  defaults,
  messages: {
    title: 'Movies',
    flash: {
      success: {
        delete: 'The movie "{item}" has been deleted successfully',
        save: 'The movie "{item}" has been saved successfully'
      }
    },
    dialog: {
      delete: {
        title: 'Delete movie "{item}"',
      }
    },
    grid: {
      header: {
        title: 'Title',
        year: 'Release year',
        director: 'Director',
      }
    },
    form: {
      title: {
        edit: 'Edit movie "{item}"',
        create: 'New {singular}',
      },
      group: {
        default: 'General',
        cast: 'Cast'
      },
      field: {
        title: 'Title',
        year: 'Release year',
        genres: 'Genres',
        director: 'Director',
      }
    }
  }
})
