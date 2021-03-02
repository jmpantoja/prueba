import {ActionOptions, AdminContext, Record} from "~/plugins/admin/src/admin";

const action: ActionOptions = {
  name: 'grid.edit',
  icon: "mdi-pencil",
  color: 'primary',
  exec({form}: AdminContext, params: { record: Record }): Promise<any> {
    return form.load(params.record)
  }
}

export default action
