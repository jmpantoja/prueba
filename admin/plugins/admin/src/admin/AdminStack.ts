import Admin from './Admin'

class AdminStack {
  private _stack: Map<string, Admin>;

  public constructor() {
    this._stack = new Map<string, Admin>()
  }

  public hasAdmin(name: string): boolean {
    return this._stack.has(name)
  }

  public add(name: string, admin: Admin) {
    this._stack.set(name, admin)
  }

  public byName(name: string): Admin | {} {
    return this._stack.get(name) || {}
  }
}

export default AdminStack;
