import {AdminContext, Button, ButtonList, ButtonOptionsList, ToolbarOptions} from "~/plugins/atn/src/index";

class Toolbar {
  private _namespace: string;
  private _buttons: ButtonList;


  public constructor(namespace: string, context: AdminContext, options: ToolbarOptions) {
    this._namespace = namespace;
    this._buttons = this.initButtons(options.buttons)
  }

  private initButtons(actions?: ButtonOptionsList): ButtonList {
    const entries = Object
      .entries(actions || {})
      .map(([key, options]) => {
        const button = new Button(this._namespace, options)
        return [key, button]
      })

    return Object.fromEntries(entries)
  }

  public get namespace(): string {
    return this._namespace;
  }

  public get buttons(): ButtonList {
    return this._buttons;
  }
}

export default Toolbar
