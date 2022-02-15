class Settings {

  private _audio: Boolean = false

  public get audio(): Boolean {
    return this._audio;
  }

  public set audio(value: Boolean) {
    this._audio = value;
  }
}

export {Settings}
