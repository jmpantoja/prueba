import {FormOptions, Props} from "~/plugins/atn/src";

const form: FormOptions = {
  width: 500,
  default: {
    id: null,
  },
  groups: [
    {
      label: 'personal',
      fields: [
        {key: 'name', type: 'v-text-field'},
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
