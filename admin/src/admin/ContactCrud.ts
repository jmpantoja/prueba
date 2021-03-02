import {Crud} from "~/plugins/admin/types";
import Item from "~/plugins/admin/src/crud/Item";
import Grid from "~/plugins/admin/src/crud/Grid";

class ContactCrud extends Crud {
  public get default(): Item {
    const item = {
      id: null,
      fullName: {}
    };
    return item;

  }

  public async create(item: object): Promise<object> {
    return await this.context.$axios.$post('/contacts', item)
  }

  public async read(params: object): Promise<Item[]> {
    return await this.context.$axios.$get('/contacts', {
      params
    })
  }

  public update(item: object): Promise<Item> {
    // @ts-ignore
    return this.context.$axios.$put(`/contacts/${item.id}`, item)
  }

  public async delete(item: object): Promise<Item> {

    // @ts-ignore
    return this.context.$axios.$delete(`/contacts/${item.id}`)
  }

  public async findById(id: string): Promise<Item> {
    return await this.context.$axios.$get(`/contacts/${id}`)
  }

}

export default ContactCrud
