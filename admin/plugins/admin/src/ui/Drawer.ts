declare module '@nuxt/types' {
  interface Context {
    $drawer: Drawer
  }
}

class Drawer {
  private _drawer: boolean = true;

  get drawer(): boolean {
    return this._drawer;
  }

  set drawer(value: boolean) {
    this._drawer = value;
  }

  toggle() {
    this._drawer = !this._drawer
  }
}

export default Drawer;
