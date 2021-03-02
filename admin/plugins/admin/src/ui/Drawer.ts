class Drawer {
  private _open: boolean = true;

  get open(): boolean {
    return this._open;
  }

  set open(value: boolean) {

    this._open = value;
  }

  toggle() {
    this._open = !this._open
  }
}

export default Drawer;
