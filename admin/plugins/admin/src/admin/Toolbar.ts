import ToolbarMapper from "~/plugins/admin/src/admin/ToolbarMapper";

type Context = {
  mapper: ToolbarMapper
}

class Toolbar {
  private _title: string;

  public constructor(options: Context) {
    const mapper = options.mapper
    this._title = mapper.getTitle();
  }

  public get title(): string {
    return this._title;
  }
}

export default Toolbar
