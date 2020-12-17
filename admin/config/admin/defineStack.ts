import {AdminContext} from "~/plugins/admin/types";
import AdminStack from "~/plugins/admin/src/admin/AdminStack";
import ContactAdmin from "~/src/admin/ContactAdmin";


export default function (stack: AdminStack, app: AdminContext){
  stack.add('contact', new ContactAdmin(app))
}
