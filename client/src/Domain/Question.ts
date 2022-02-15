// import {Question} from "~/types/app";


type QuestionInput = {
  id: string;
  question: string;
  answer: string;
  audio: string;
}

class Question {
  private _id: string;
  private _question: string;
  private _answer: string;
  private _audio: HTMLAudioElement;
  private _is_ok: Boolean | undefined

  public constructor(input: QuestionInput) {
    this._id = input.id;
    this._question = input.question;
    this._answer = input.answer;
    this._audio = new Audio('https://www.wordreference.com/' + input.audio);
  }

  public get id(): string {
    return this._id;
  }

  public get question(): string {
    return this._question;
  }

  public get answer(): string {
    return this._answer;
  }

  public speak(): void {
    this._audio.play()
  };

  public check(input: String): Boolean {
    const is_ok = input === this.answer;

    this._is_ok = is_ok

    return is_ok;
  }


  get isOk(): Boolean | undefined {
    return this._is_ok;
  }
}


export {
  Question
}
