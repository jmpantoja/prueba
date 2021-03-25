import {AdminContext, Button, ButtonList, ButtonOptionsList, ToolbarOptions} from "~/plugins/atn/src/index";

class Toolbar {
  private _buttons: ButtonList;

  public constructor(context: AdminContext, options: ToolbarOptions) {
    this._buttons = this.initButtons(options.buttons)
  }

  private initButtons(actions?: ButtonOptionsList): ButtonList {
    const entries = Object
      .entries(actions || {})
      .map(([key, options]) => {
        const action = new Button({
          ...options
        })

        const name = options.name || key
        return [name, action]
      })

    return Object.fromEntries(entries)
  }

  public get buttons(): ButtonList {
    return this._buttons;
  }
}

export default Toolbar
