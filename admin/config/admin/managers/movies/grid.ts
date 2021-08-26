import {GridOptions} from "~/plugins/atn/src";

const grid: GridOptions = {
  options: {
    sortBy: ['id'],
    sortDesc: [false],
  },
  filters: [
    {
      key: 'title'
    }
  ],
  columns: [
    {
      key: 'title',
      text: 'title',
      type: 'atn-grid-movie-title',
      sortable: true,
    },
    {
      key: 'year',
      text: 'year',
      //  type: 'atn-grid-movie-title',
      sortable: true,
    },
    {
      key: 'director',
      text: 'director',
      type: 'atn-grid-movie-director',
      sortable: true,
    }
  ],
  buttons: [
    {
      icon: 'mdi-pencil',
      color: 'primary',
      action: 'edit'
    },
    {
      icon: 'mdi-delete-outline',
      color: 'error',
      action: 'delete'
    }
  ]
}

export default grid;