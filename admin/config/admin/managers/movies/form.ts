import {FormOptions, Props} from "~/plugins/atn/src";

const form: FormOptions = {
  default: {
    id: null,
  },
  groups: [
    {
      label: 'default',
      fields: [
        {key: 'title'},
        {
          key: 'year',
          type: 'atn-field-year',
          width: '40%',
          props: {
            min: 1900,
            max: new Date().getFullYear() + 10
          }
        },
      ]
    },
    {
      label: 'genres',
      fields: [
        {
          key: 'genres',
          type: 'atn-field-entity-chips',
          props: {
            entity: 'genres',
            itemText: "name",
          }
        },
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
