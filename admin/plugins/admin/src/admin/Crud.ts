import Form from "./Form";
import Grid from "./Grid";
import Panel from "./Panel";
import Dialog from "./Dialog";

import {AdminContext} from "../../types";
import {reactive, UnwrapRef} from "@nuxtjs/composition-api";


abstract class Crud {
  private _context: AdminContext;
  private _grid: UnwrapRef<Grid>;
  private _panel: UnwrapRef<Panel>;
  private _form: UnwrapRef<Form>;
  private _dialog: UnwrapRef<Dialog>;

  public constructor(context: AdminContext) {
    this._context = context

    const grid = this.buildGrid(context);
    const panel = this.buildPanel(context);
    const form = this.buildForm(context);
    const dialog = this.buildDialog(context);

    this._grid = reactive(grid)
    this._panel = reactive(panel)
    this._form = reactive(form)
    this._dialog = reactive(dialog)
  }

  public get context(): AdminContext {
    return this._context
  }

  public abstract get default(): object;

  public abstract create(item: object): Promise<object>

  public abstract read(params: object): Promise<object[]>;

  public abstract update(item: object): Promise<object>

  public abstract delete(item: object): Promise<object>

  protected buildGrid(context: AdminContext): Grid {
    return new Grid(context, this);
  }

  protected buildPanel(context: AdminContext): Panel {
    return new Panel(context)
  }

  protected buildForm(context: AdminContext): Form {
    return new Form(context, this);
  }

  protected buildDialog(context: AdminContext): Dialog {
    return new Dialog(context, this);
  }

  get grid(): UnwrapRef<Grid> {
    return this._grid;
  }

  get panel(): UnwrapRef<Panel> {
    return this._panel;
  }

  get form(): UnwrapRef<Form> {
    return this._form;
  }

  get dialog(): UnwrapRef<Dialog> {
    return this._dialog;
  }


}

export default Crud;
