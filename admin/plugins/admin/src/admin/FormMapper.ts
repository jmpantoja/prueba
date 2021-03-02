import {
  ColNumber,
  FormAction,
  FormActionList,
  FormFieldList,
  FormLayout,
  FormRow
} from "~/plugins/admin/src/admin/index";

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

const actionDefaults = {
  slot: 'right',
  color: 'primary'
};


class FormMapper {
  private _width: number = 512;
  private _layout: FormLayout = {rows: [], tabs: []};
  private _actions: FormActionList = {
    left: {},
    right: {},
  }

  public constructor() {
    this.addAction('onDelete', {
      label: 'form.delete',
      color: 'error',
      slot: 'left'
    })

    this.addAction('onSave', {
      label: 'form.save',
    })
  }

  public setWidth(width: number): FormMapper {
    this._width = width;
    return this
  }

  public get width(): number {
    return this._width;
  }

  public addAction(name: string, options: FormAction | string) {
    if (typeof options === 'string') {
      options = {label: options}
    }
    const action = {
      label: options.label,
      color: options.color || 'primary'
    }

    if (options.slot === 'left') {
      this._actions.left[name] = action
      return
    }
    this._actions.right[name] = action
  }

  public get actions(): FormActionList {
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
