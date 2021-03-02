class ToolbarMapper {
  private _title: string;

  public constructor() {
    this._title = ''
  }

  public getTitle(): string {
    return this._title;
  }

  public setTitle(value: string) {
    this._title = value;
  }

}

export default ToolbarMapper
