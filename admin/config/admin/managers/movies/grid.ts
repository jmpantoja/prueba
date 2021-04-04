import {GridOptions} from "~/plugins/atn/src";

const grid: GridOptions = {
  options: {
    sortBy: ['id'],
    sortDesc: [false],
  },
  filters: [
    {
      key: 'name'
    }
  ],
  columns: [
    {
      key: 'title',
      text: 'title',
    //  type: 'atn-grid-movie-title',
      sortable: true,
    },
    {
      key: 'year',
      text: 'year',
      //  type: 'atn-grid-movie-title',
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
