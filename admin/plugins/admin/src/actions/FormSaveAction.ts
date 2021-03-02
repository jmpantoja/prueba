import {ActionOptions, AdminContext, Record} from "~/plugins/admin/src/admin";

const action: ActionOptions = {
  name: 'form.save',
  label: "action.save",
  color: 'primary',
  message: {
    success: 'flash.save.success',
    failure: 'flash.save.failure'
  },
  exec({form}: AdminContext, params: { record: Record }): Promise<Record> {
    return form.save(params.record)
  },
  enabled({form}: AdminContext, params?: object) {
    return form.valid
  }
}

export default action
