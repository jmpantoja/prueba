import {ActionContext, ActionList, Record} from "~/plugins/atn/src";

const actions: ActionList = {
  create: {
    roles: ['EDITOR'],
    run({form}: ActionContext) {
      form.show()
    }
  },
  edit: {
    roles: ['REVISOR'],
    run({form, grid}: ActionContext, params) {
      grid.loading = true
      form.show(params.item).then(() => {
        grid.loading = false
      })
    }
  },
  delete: {
    dialog: {
      title: 'dialog.delete.title',
      message: 'dialog.delete.message',
    },
    disabled(context: ActionContext, params: { item: Record }): boolean {
      return !!!params.item.id
    },
    run({dialog, form, grid, flash}: ActionContext, params: { item: Record }) {
      form.delete(params.item).then(() => {
        flash.success('delete', params)
        grid.refresh()
      })
    }
  },
  save: {
    roles({form}: ActionContext): string[] {
      return form.editMode ? ['EDITOR', 'ADMIN'] : ['ADMIN']
    },
    disabled({form}: ActionContext): boolean {
      return !form.valid
    },
    run({form, grid, flash}: ActionContext, params: { item: Record }) {
      if (!form.valid) {
        return
      }
      form.save(params.item).then(() => {
        flash.success('save', params)
        grid.refresh()
      })
    }
  },
  export: {
    run({form}: ActionContext, params) {
      alert('export')
    }
  },
}

export default actions
