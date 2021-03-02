import {Admin, ApiClient, FilterMapper, FormMapper, GridMapper} from "~/plugins/admin/src/admin";
import VDate from "~/plugins/admin/components/form/VDate.vue";
import VFullname from "~/components/VFullname.vue";


class ContactAdmin extends Admin {

  protected setUpMessages(messages: Map<string, string>): void {
    messages.set('title', 'app.title')
  }

  protected setUpClient(client: ApiClient): void {
    client.endpoint = '/contacts'
  }

  protected setUpGrid(mapper: GridMapper): void {
    mapper
      .addHeader('id')
      .addHeader('fullName.lastName', {
        text: 'Nombre',
        sortable: true
      })
      .addHeader('birthDate', {
        text: 'Fec. Nac',
        sortable: true,
      })
      .addHeader('age', {
        text: 'Edad',
        divider: true,
        align: "right"
      })
  }

  protected setUpForm(mapper: FormMapper): void {
    mapper
      .setWidth(750)
      .rows((panel) => {
        panel
          .col(8, {
            fullName: {label: 'Nombre Completo', type: VFullname},
          })
          .col(4, {
            birthDate: {label: 'Fec. Nac', type: VDate},
          })
      })

  }

  protected setUpFilters(mapper: FilterMapper): void {
    mapper.addFilter('fullName.lastName', {
      label: 'Last Name',
    })
  }

}

export default ContactAdmin
