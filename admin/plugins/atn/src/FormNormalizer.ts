import {FormField, FormGroup} from "~/plugins/atn/src/index";

class FormNormalizer {
  private _groups: FormGroup[];


  public static normalize(groups: FormGroup[]): FormGroup[] {
    const normalizer = new FormNormalizer(groups)
    return normalizer.groups
  }

  private constructor(groups: FormGroup[]) {
    this._groups = this.normalize(groups)
  }


  public get groups(): FormGroup[] {
    return this._groups;
  }

  private normalize(row: FormGroup[]) {
    return row.map((group: FormGroup) => {
      return this.normalizeGroup(group);
    })
  }

  private normalizeGroup(group: FormGroup) {
    return {
      ...group,
      fields: this.normalizeFields(group.fields),
    }
  }

  private normalizeFields(fields: FormField[]) {
    return Object.values(fields)
      .map((field: FormField) => {
        return this.normalizeField(field);
      });
  }

  private normalizeField(field: FormField) {
    return {
      type: 'v-text-field',
      label: field.key,
      width: '100%',
      ...field
    }
  }

}

export default FormNormalizer
