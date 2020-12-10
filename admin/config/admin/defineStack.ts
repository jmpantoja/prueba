import AdminStack from "~/plugins/admin/src/AdminStack";

import ContactGrid from "~/components/contact/ContactGrid.vue"

export default function (stack: AdminStack){
  stack.add('contact', {
    grid: ContactGrid
  })
}
