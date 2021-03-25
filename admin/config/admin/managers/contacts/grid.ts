import {GridOptions} from "~/plugins/atn/src";

const grid: GridOptions = {
  options: {
    sortBy: ['id'],
    sortDesc: [false],
  },
  filters: [
    {
      key: 'fullName'
    }
  ],
  columns: [
    {
      key: 'id',
      width: '5em',
      sortable: false,
    },
    {
      key: 'fullName.lastName',
      text: 'name',
      sortable: true,
    },
    {
      key: 'birthDate',
      type: 'atn-grid-date',
      sortable: true,
      width: '12em',
      divider: true
    },
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
