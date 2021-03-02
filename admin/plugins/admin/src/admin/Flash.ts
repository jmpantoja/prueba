class Flash {
  private _message: string = ''
  private _visible: boolean = false
  private _color: string = 'success';
  private _reason?: string;

  public set visible(value: boolean) {
    this._visible = value;
  }

  public get visible(): boolean {
    return this._visible;
  }

  public get message(): string {
    return this._message;
  }

  public get reason(): string | undefined {
    return this._reason;
  }

  public get color(): string {
    return this._color;
  }

  public success(message: string) {
    this._message = message;
    this._color = 'success'
    this._visible = true
  }

  public error(message: string, reason: string) {
    this._message = message;
    this._reason = reason;
    this._color = 'error'
    this._visible = true
  }
}

export default Flash;
