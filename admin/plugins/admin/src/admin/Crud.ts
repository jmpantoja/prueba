import Form from "./Form";
import Grid from "./Grid";
import Panel from "./Panel";
import DeleteDialog from "./DeleteDialog";
import Toolbar from "./Toolbar";
import Toast from "./Toast";

import {AdminContext} from "../../types";
import {reactive, UnwrapRef} from "@nuxtjs/composition-api";
import Item from "~/plugins/admin/src/admin/Item";

abstract class Crud {
  private _context: AdminContext;
  private _grid: UnwrapRef<Grid>;
  private _panel: UnwrapRef<Panel>;
  private _form: UnwrapRef<Form>;
  private _deleteDialog: UnwrapRef<DeleteDialog>;
  private _toolbar: UnwrapRef<Toolbar>;
  private _toast: UnwrapRef<Toast>;

  public constructor(context: AdminContext) {
    this._context = context

    const grid = this.buildGrid(context);
    const panel = this.buildPanel(context);
    const form = this.buildForm(context);
    const dialog = this.buildDeleteDialog(context);
    const toolbar = this.buildToolbar(context);
    const toast = this.buildToast(context);

    this._grid = reactive(grid)
    this._panel = reactive(panel)
    this._form = reactive(form)
    this._deleteDialog = reactive(dialog)
    this._toolbar = reactive(toolbar)
    this._toast = reactive(toast)
  }

  public get context(): AdminContext {
    return this._context
  }

  public abstract get default(): Item;

  public abstract create(item: Item): Promise<object>

  public abstract read(params: object): Promise<Item[]>;

  public abstract findById(id: string): Promise<Item>;

  public abstract update(item: Item): Promise<Item>

  public abstract delete(item: Item): Promise<Item>

  protected buildGrid(context: AdminContext): Grid {
    return new Grid(context, this);
  }

  protected buildPanel(context: AdminContext): Panel {
    return new Panel(context)
  }

  protected buildForm(context: AdminContext): Form {
    return new Form(context, this);
  }

  protected buildDeleteDialog(context: AdminContext): DeleteDialog {
    return new DeleteDialog(context, this);
  }

  protected buildToolbar(context: AdminContext): Toolbar {
    return new Toolbar(context, this);
  }

  protected buildToast(context: AdminContext): Toast {
    return new Toast(context, this);
  }

  public get grid(): UnwrapRef<Grid> {
    return this._grid;
  }

  public get panel(): UnwrapRef<Panel> {
    return this._panel;
  }

  public get form(): UnwrapRef<Form> {
    return this._form;
  }

  public get deleteDialog(): UnwrapRef<DeleteDialog> {
    return this._deleteDialog;
  }

  public get toolbar(): UnwrapRef<Toolbar> {
    return this._toolbar;
  }

  public get toast(): UnwrapRef<Toast> {
    return this._toast;
  }

}

export default Crud;
