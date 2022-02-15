import {Question} from "~/types/app";

enum Step {
  STUDY,
  TEST,
  RESULT,
}

enum State {
  WAITING,
  SUCCESS,
  FAILURE,
}

class Workflow {

  private _step: Step = Step.STUDY
  private _state: State = State.WAITING

  public advance(): void {
    this._step++
  }

  public get step(): Step {
    return this._step
  }

  public get is_studing(): Boolean {
    return this.step === Step.STUDY
  }

  public get is_waiting(): Boolean {
    return this.step === Step.TEST && this._state === State.WAITING
  }

  public get is_finalized(): Boolean {
    return this.step === Step.RESULT
  }

  public get is_success(): Boolean {
    return this.step === Step.TEST && this._state === State.SUCCESS
  }

  public get is_failure(): Boolean {
    return this.step === Step.TEST && this._state === State.FAILURE
  }

  public answer(question: Question, input: String): Boolean {
    const is_ok = question.check(input)
    this._state = is_ok ? State.SUCCESS : State.FAILURE

    return is_ok
  }

  public reset(): void {
    this._state = State.WAITING
  }

  public resume(): void {
    this._step = Step.STUDY
  }
}

export {
  Step,
  State,
  Workflow
}
