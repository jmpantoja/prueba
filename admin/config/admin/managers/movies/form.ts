import {FormOptions, Props} from "~/plugins/atn/src";

const form: FormOptions = {
  default: {
    id: null,
    fullName: {}
  },
  groups: [
    {
      label: 'default',
      fields: [
        {key: 'title'},
        {key: 'year', type: 'atn-field-movie-year', width:'40%'},
        {key: 'genres', type: 'atn-field-movie-genres', },
      ]
    },
  ],
  buttons: [
    {
      text: 'save',
      color: 'primary',
      action: 'save'
    },
    {
      text: 'delete',
      color: 'error',
      slot: 'left',
      action: 'delete',
      tile: false,
      customize: (props: Props) => {
        props.visible = !props.disabled
      }
    }
  ]
}

export default form;
