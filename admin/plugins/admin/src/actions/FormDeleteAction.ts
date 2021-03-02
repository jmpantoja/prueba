import {ActionOptions, AdminContext, Record} from "~/plugins/admin/src/admin";

const action: ActionOptions = {
  name: 'form.delete',
  label: "action.delete",
  color: 'error',
  text: true,
  slot: 'left',
  message: {
    success: 'flash.delete.success',
    failure: 'flash.delete.failure'
  },
  dialog: {
    title: 'dialog.delete.title',
    message: 'dialog.delete.message'
  },
  exec({form}: AdminContext, params: { record: Record }): Promise<any> {
    return form.delete(params.record)
  }
}

export default action
