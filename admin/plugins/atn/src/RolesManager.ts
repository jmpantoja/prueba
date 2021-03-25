import {RoleList, RolesOptions, User} from "~/plugins/atn/src/index";

class RolesManager {
  private _map: RoleList = {};
  private _inheritance: RoleList;

  public constructor(options: RolesOptions) {
    this._inheritance = options.inheritance

    Object.keys(this._inheritance)
      .forEach((rol: string) => {
        this._map[rol] = this.explode(rol)
      })
  }

  private explode(rol: string): string[] {
    const children = this._inheritance[rol] || []
    const temp = [...children]
    children.forEach((child: string) => {
      temp.push(...this.explode(child))
    })
    return temp.map((rol: string) => {
      return rol.toLowerCase()
    })
  }

  public isGranted(roles: string[], user: User): boolean {
    const availables: string[] = []

    user.roles.map((rol: string) => {
      rol = rol.toLowerCase()
      const temp = this._map[rol] || [];
      availables.push(rol, ...temp)
    })

    return roles.some((rol) => {
      return availables.includes(rol.toLowerCase())
    })

  }
}

export default RolesManager
