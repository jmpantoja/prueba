import {AdminContext} from "~/plugins/admin/types";
import AdminStack from "~/plugins/admin/src/admin/AdminStack";
import ContactCrud from "~/src/admin/ContactCrud";


export default function (stack: AdminStack, app: AdminContext){
  stack.add('contact', new ContactCrud(app))
}
