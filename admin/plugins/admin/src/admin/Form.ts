import AdminContext from "~/plugins/admin/src/app/AdminContext";
import Crud from "~/plugins/admin/src/admin/Crud";
import Dialog from "~/plugins/admin/src/admin/Dialog";
import Item from "~/plugins/admin/src/admin/Item";

const _ = require('lodash')

class Form extends Dialog {
  private _valid: boolean;
  private _item: Item | null;

  public constructor(context: AdminContext, crud: Crud) {
    super(context, crud)

    this._valid = false
    this._item = null
  }

  get actionName(): string {
    if (this._item) {
      return this._item.id ? 'edit' : 'create'
    }

    return 'create'
  }

  public get valid(): boolean {
    return this._valid;
  }

  public set valid(valid: boolean) {
    this._valid = valid;
  }

  public show(item: Item | null) {
    this._item = _.cloneDeep(item)
    return super.show(item)
  }

  public get title() {
    return `dialog.${this.actionName}.title`
  }

  public get item(): object {
    return this._item || this.default;
  }

  public get default(): object {
    return this._crud.default
  }

}

export default Form;
