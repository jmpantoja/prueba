import {RolesOptions} from "~/plugins/atn/src";

const roles: RolesOptions = {
  inheritance: {
    admin: ['editor', 'revisor'],
    editor: ['revisor'],
    revisor: [],
  }
}

export default roles
