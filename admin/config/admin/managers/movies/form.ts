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
          type: 'atn-field-relation',
          props: {
            type: 'labels',
            entity: 'genres',
            itemText: "name",
          }
        },
      ]
    },
    {
      label: 'director',
      fields: [
        {
          key: 'director',
          type: 'atn-field-relation',
          props: {
            type: 'one',
            entity: 'directors',
            itemText: (item: any) => {
              return `${item.name.lastName}, ${item.name.name}`;
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
