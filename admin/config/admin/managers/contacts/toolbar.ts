import {ToolbarOptions} from "~/plugins/atn/src";

const toolbar: ToolbarOptions = {
  buttons: [
    {
      icon: 'mdi-plus',
      large: true,
      action: 'create'
    },
    {
      icon: 'mdi-download',
      large: true,
      action: 'export'
    }
  ]
}

export default toolbar;
