declare module '@nuxt/types' {
  interface Context {
    $fullScreen: FullScreen
  }
}

interface FullScreenDocument {
  exitFullscreen: Function
  mozCancelFullScreen: Function
  webkitExitFullscreen: Function
  msExitFullscreen: Function

  fullscreenElement: boolean
  mozFullScreenElement: boolean
  webkitFullscreenElement: boolean
  msFullscreenElement: boolean

  documentElement: HTMLElement
}

interface FullScreenElement {
  requestFullscreen: Function
  mozRequestFullScreen: Function
  webkitRequestFullScreen: Function
  msRequestFullscreen: Function

}

class FullScreen {
  private _document: FullScreenDocument;
  private _element: FullScreenElement;
  private _request: Function;
  private _cancel: Function;

  public constructor(input: Document) {
    this._document = ((input as unknown) as FullScreenDocument)
    this._element = ((this._document.documentElement as unknown) as FullScreenElement)

    this._cancel = this._document.exitFullscreen
      || this._document.mozCancelFullScreen
      || this._document.webkitExitFullscreen
      || this._document.msExitFullscreen

    this._request = this._element.requestFullscreen
      || this._element.mozRequestFullScreen
      || this._element.webkitRequestFullScreen
      || this._element.msRequestFullscreen
  }

  public toggle() {
    if (this.isFullScreen()) {
      this._request.call(this._element)
    } else {
      this._cancel.call(this._document)
    }
  }

  private isFullScreen() {
    return !this._document.fullscreenElement
      && !this._document.mozFullScreenElement
      && !this._document.webkitFullscreenElement
      && !this._document.msFullscreenElement;
  }
}

export default FullScreen;
