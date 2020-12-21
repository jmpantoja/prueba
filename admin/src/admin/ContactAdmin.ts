import {Admin, Grid} from "~/plugins/admin/types";
import ContactCrud from "~/components/contact/ContactCrud.vue";

class ContactGrid extends Grid {

  public get headers(): object[] {
    return [
      {text: 'id', value: 'id', sortable: false},
      {text: 'name', value: 'fullName.lastName', width: 'max-content'},
      {text: 'birthDate', value: 'birthDate', width: 'min-content'},
      {text: 'age', value: 'age', sortable: false}
    ]
  }

  async fetch(params: object): Promise<object[]> {
    return await this.context.$axios.$get('/contacts', {
      params
    })
  }

}

class ContactAdmin extends Admin {

  public get crud() {
    return ContactCrud
  }

  public get grid(): Grid {
    return new ContactGrid(this.context);
  }
}

export default ContactAdmin
