const diff = require("fast-diff")

interface DiffItem {
  type: 'equal' | 'insert' | 'delete';
  letters: String;
}

class Difference {
  private _given!: DiffItem[];
  private _expected!: DiffItem[];

  constructor(answer: String, input: String) {

    if (answer === input) {
      this.initRight(input);
      return;
    }

    this.initWrong(answer, input);

  }

  private initRight(input: String) {
    this._given = [
      {
        letters: input,
        type: "equal"
      }
    ]

    this._expected = []
  }

  private initWrong(answer: String, input: String) {
    const items = this.getItems(answer, input)

    this._given = items
      .filter((item: DiffItem) => {
        return item.type !== 'delete'
      })

    this._expected = items
      .filter((item: DiffItem) => {
        return item.type !== 'insert'
      })
  }

  private getItems(answer: String, input: String): DiffItem[] {
    const difference = diff(answer, input);
    return difference.map(this.mapItem)
  }

  private mapItem(item: Array<any>) {
    const types = ['delete', 'equal', 'insert']
    const index: number = item[0] + 1

    return {
      type: types[index],
      letters: item[1]
    }
  }

  public get given(): DiffItem[] {
    return this._given
  }

  public get expected(): DiffItem[] {
    return this._expected
  }

}

export {
  Difference,
  DiffItem
}
