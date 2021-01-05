import {Crud} from "~/plugins/admin/types";

class ContactCrud extends Crud {
  public get default(): object {
    return {
      fullName: {}
    };
  }

  public async create(item: object): Promise<object> {
    return await this.context.$axios.$post('/contacts', item)
  }

  public async read(params: object): Promise<object[]> {
    return await this.context.$axios.$get('/contacts', {
      params
    })
  }

  public update(item: object): Promise<object> {
    // @ts-ignore
    return this.context.$axios.$put(`/contacts/${item.id}`, item)
  }

  public delete(item: object): Promise<object> {
    // @ts-ignore
    return this.context.$axios.$delete(`/contacts/${item.id}`)
  }

}

export default ContactCrud
