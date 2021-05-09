import {FormOptions, Props} from "~/plugins/atn/src";

const form: FormOptions = {
  width: 900,
  default: {
    id: null,
  },
  groups: [
    {
      label: 'default',
      fields: [
        {
          key: 'title',
        },
        {
          key: 'year',
          type: 'atn-field-year',
          width: '300px',
          props: {
            width: '200px',
            min: 1900,
            max: new Date().getFullYear() + 10
          }
        },
        {
          key: 'genres',
          type: 'atn-field-entity-listbox',
          props: {
            entity: 'genres',
            itemText: "name",
          }
        },
      ]
    },
    {
      label: 'cast',
      fields: [
        {
          label: 'director',
          key: 'director',
          type: 'atn-field-entity',
          props: {
            entity: 'directors',
            itemText: (item: any) => {
              const fullName = item.name || {}
              return `${fullName.lastName}, ${fullName.name}`;
            },
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
