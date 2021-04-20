import {AdminOptions} from "~/plugins/atn/src";
import grid from "./grid";
import form from "./form";
import toolbar from "./toolbar";
import actions from "./actions";

const admin: AdminOptions = {
  i18n: {
    namespace: "admin.genres"
  },
  api: {
    endpoint: '/genres'
  },
  toolbar,
  grid,
  form,
  actions

}
export default admin
