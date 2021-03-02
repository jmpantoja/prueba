import {
  Action,
  ActionList,
  ActionOptions,
  ColNumber,
  FormFieldList,
  FormLayout,
  FormRow
} from "~/plugins/admin/src/admin/index";

import {FormDeleteAction, FormSaveAction} from "~/plugins/admin/src/actions";

class FieldPanel {
  private _rows: Array<FormRow>;
  private _current: number;

  constructor() {
    this._current = -1
    this._rows = []
    this.break()
  }

  public col(cols: ColNumber, fields: FormFieldList, props?: object): FieldPanel {
    this._rows[this._current].push({
      fields,
      props: {
        ...props,
        cols
      }
    })
    return this
  }

  public break(): FieldPanel {
    this._rows.push([])
    this._current++
    return this
  }

  public get rows(): Array<any> {
    return this._rows;
  }
}

class FormMapper {
  private _width: number = 750;
  private _editTitle: string = '';
  private _createTitle: string = '';
  private _layout: FormLayout = {rows: [], tabs: []};
  private _actions: ActionList = []

  public constructor() {
    this.addAction(FormDeleteAction)
    this.addAction(FormSaveAction)
  }

  public setTitle(edit: string, create: string): FormMapper {
    this._editTitle = edit;
    this._createTitle = create;
    return this
  }

  public setWidth(width: number): FormMapper {
    this._width = width;
    return this
  }

  public get width(): number {
    return this._width;
  }

  public get editTitle(): string {
    return this._editTitle;
  }

  public get createTitle(): string {
    return this._createTitle;
  }

  public addAction(options: ActionOptions) {
    options.slot = options.slot ?? 'right'
    this._actions.push(new Action(options))
  }

  public get actions(): ActionList {
    return this._actions;
  }

  public addTab(label: string, configurator: (panel: FieldPanel) => void): FormMapper {
    const panel = new FieldPanel()
    configurator(panel)

    this._layout.tabs.push({
      label: label,
      rows: panel.rows
    })

    return this
  }

  public rows(configurator: (panel: FieldPanel) => void): FormMapper {
    const panel = new FieldPanel()
    configurator(panel)
    this._layout.rows = panel.rows

    return this
  }

  public get layout(): FormLayout {
    return this._layout;
  }
}

export default FormMapper;
