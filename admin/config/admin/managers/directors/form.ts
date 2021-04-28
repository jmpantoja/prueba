import {FormOptions, Props} from "~/plugins/atn/src";

const form: FormOptions = {
  width: 700,
  default: {
    id: null,
    name: {}
  },
  groups: [
    {
      label: 'personal',
      fields: [
        {key: 'name', type: 'atn-field-fullname'},
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
