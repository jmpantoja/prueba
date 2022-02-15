import {Pagination, Question, Settings, Workflow} from "~/types/app";

type Score = {
  success: number,
  failure: number,
  total: number
}

class Deck {
  private readonly _list: Question[];
  private readonly _pagination: Pagination
  private readonly _settings: Settings;
  private _workflow: Workflow;

  constructor(list: Question[]) {
    this._list = list
    this._pagination = new Pagination(list.length - 1)
    this._settings = new Settings()
    this._workflow = new Workflow()
  }

  public get current(): Question {
    const cursor = this._pagination.current;
    return this._list[cursor]
  }

  public get pagination(): Pagination {
    return this._pagination;
  }

  public get settings(): Settings {
    return this._settings;
  }

  public get workflow(): Workflow {
    return this._workflow;
  }

  public get score(): Score {
    const success = this._list.filter((question: Question) => {
      return question.isOk
    }).length

    const failure = this._list.filter((question: Question) => {
      return !question.isOk
    }).length

    const total = this._list.length

    return {
      success,
      failure,
      total
    }
  }

  public advance(): void {
    this.workflow.advance()
    this.pagination.first()
  }

  public resume() {
    this.workflow.resume()
    this.pagination.first()
  }

}

export {
  Deck,
  Score
}
