import Crud from './Crud'

class AdminStack {
  private _stack: Map<string, Crud>;

  public constructor() {
    this._stack = new Map<string, Crud>()
  }

  public hasAdmin(name: string): boolean {
    return this._stack.has(name)
  }

  public add(name: string, admin: Crud) {
    this._stack.set(name, admin)
  }

  public byName(name: string): Crud | {} {
    return this._stack.get(name) || {}
  }
}

export default AdminStack;
