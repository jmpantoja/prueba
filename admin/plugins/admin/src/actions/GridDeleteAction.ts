import {ActionOptions, AdminContext, Record} from "~/plugins/admin/src/admin";

const action: ActionOptions = {
  name: 'grid.delete',
  icon: "mdi-delete-outline",
  color: 'error',
  dialog: {
    title: 'dialog.delete.title',
    message: 'dialog.delete.message'
  },
  message: {
    success: 'flash.delete.success',
    failure: 'flash.delete.failure'
  },
  exec({form}: AdminContext, params: { record: Record }): Promise<any> {
    return form.delete(params.record)
  }
}

export default action
