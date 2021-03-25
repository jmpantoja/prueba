import {AdminOptions} from "~/plugins/atn/src";
import grid from "~/config/admin/managers/contacts/grid";
import form from "~/config/admin/managers/contacts/form";
import toolbar from "~/config/admin/managers/contacts/toolbar";
import actions from "~/config/admin/managers/contacts/actions";

const admin: AdminOptions = {
  roles: {
    inheritance: {
      admin: ['editor', 'revisor'],
      editor: ['revisor'],
      revisor: [],
    }
  },
  i18n: {
    namespace: "admin.contact"
  },
  api: {
    endpoint: '/contacts'
  },
  toolbar,
  grid,
  form,
  actions

}
export default admin
