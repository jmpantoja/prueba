import {FormOptions, Props} from "~/plugins/atn/src";

const form: FormOptions = {
  default: {
    id: null,
    fullName: {}
  },
  groups: [
    {
      label: 'personal',
      fields: [
        {key: 'fullName', type: 'atn-field-fullname'},
        {key: 'birthDate', type: 'atn-field-date', width: '40%'}
      ]
    },
    {
      label: 'address',
      fields: [
        {key: 'fullName', type: 'atn-field-fullname'},
        {key: 'birthDate', type: 'atn-field-date', width: '40%'}
      ]
    }
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
