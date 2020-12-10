//type AdminMap = Record<string, Admin>;

type AdminConfig = {
  grid: any
}

class Admin {
  private _config: AdminConfig;

  constructor(config: AdminConfig) {
    this._config = config;
  }

  get grid(){
    return this._config.grid
  }

}

class AdminStack {
  private _stack: Map<string, Admin>;

  public constructor() {
    this._stack = new Map<string, Admin>()
  }

  public add(name: string, config: AdminConfig) {
    this._stack.set(name, new Admin(config))
  }

  public byName(name: string): Admin | undefined {

    return this._stack.get(name)
  }
}

//const admin = new Admin();
export default AdminStack;
