import {ToolbarOptions} from "~/plugins/atn/src";

const toolbar: ToolbarOptions = {
  buttons: [
    {
      icon: 'mdi-download',
      large: true,
      action: 'export'
    },
    {
      icon: 'mdi-plus',
      large: true,
      action: 'create'
    }
  ]
}

export default toolbar;
