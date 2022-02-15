class Pagination {

  private _cursor: number;
  private _max: number;

  public constructor(max: number) {
    this._cursor = 0
    this._max = max
  }

  public get current(): number {
    return this._cursor
  }

  public first(): void {
    this._cursor = 0
  }

  public previous(): void {
    if (this._cursor <= 0) {
      return
    }
    this._cursor--
  }

  public next(): void {
    if (this._cursor >= this._max) {
      return
    }
    this._cursor++
  }

  public get isFirst(): boolean {
    return this._cursor <= 0;
  }


  public get isLast(): boolean {
    return this._cursor >= this._max
  }

}

export {
  Pagination
}
