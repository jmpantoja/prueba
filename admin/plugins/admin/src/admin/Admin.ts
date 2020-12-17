import Grid from "./Grid";
import {AdminContext} from "../../types";

abstract class Admin {
  protected context: AdminContext;

  public constructor(context: AdminContext) {
    this.context = context
  }

  public abstract get grid(): Grid
}

export default Admin;
