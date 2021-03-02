import Dialog from "~/plugins/admin/src/crud/Dialog";

class DeleteDialog extends Dialog {
  public get title(): string {
    return 'dialog.delete.title'
  }

  public get text(): string {
    return 'dialog.delete.text';
  }

  get actionName(): string {
    return "delete";
  }
}

export default DeleteDialog;
