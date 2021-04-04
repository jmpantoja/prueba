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
    // {
    //   key: 'id',
    //   width: '5em',
    //   sortable: false,
    // },
    {
      key: 'name',
      text: 'name',
//      type: 'v-text-field',
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
