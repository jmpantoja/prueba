import {Admin, ApiClient, FilterMapper, FormMapper, GridMapper, Record, ToolbarMapper} from "~/plugins/XXX/src/admin";


class ContactAdmin extends Admin {

  protected setUpMessages(messages: Map<string, string>): void {
    messages.set('title', 'app.title')
  }

  protected setUpClient(client: ApiClient): void {
    client.endpoint = '/contacts'
  }

  protected setUpToolbar(mapper: ToolbarMapper): void {
    mapper.setTitle('admin.friends.title')
  }

  protected setUpGrid(mapper: GridMapper): void {
    mapper
      .addColumn('id', {
        width: '100',
      })
      .addColumn('fullName.lastName', {
        text: 'Nombre',
        sortable: true,
        type: 'v-col-fullName'
      })
      .addColumn('birthDate', {
        text: 'Fec. Nac',
        sortable: true,
        width: '10%',
        type: 'v-col-date'
      })
      .addColumn('age', {
        text: 'Edad',
        divider: true,
        align: "right",
        width: '100'
      })
  }

  protected setUpForm(mapper: FormMapper): void {
    mapper
      .setWidth(750)
      .setTitle('admin.friends.form.edit', 'admin.friends.form.create')

      .rows((panel) => {
        panel
          .col(8, {
            fullName: {label: 'Nombre Completo', type: 'v-fullname'},
          })
          .col(4, {
            birthDate: {label: 'Fec. Nac', type: 'v-date'},
          })
      })
  }

  protected setUpFilters(mapper: FilterMapper): void {
    mapper.addFilter('fullName', {
      label: 'Name',
    })
  }

  protected itemByDefault(): Record {
    return {
      id: null,
      fullName: {
        firstName: 'jose antonio',
        lastName: 'gonzales garcia'
      },
      birthDate: new Date()
    }
  }

  protected toString(item: Record) {
    const fullName = item.fullName
    return `${fullName.lastName}, ${fullName.firstName}`
  }

}

export default ContactAdmin
