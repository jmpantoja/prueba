import Vue from 'vue'

const _ = require('lodash')

class EventDispatcher {
  private _bus: Vue;

  public constructor() {
    this._bus = new Vue()
  }

  public on(event: string | string[], callback: Function): EventDispatcher {
    this._bus.$on(event, callback)
    return this;
  }

  public once(event: string | string[], callback: Function): EventDispatcher {
    this._bus.$once(event, callback)
    return this;
  }

  public off(event?: string | string[], callback?: Function): EventDispatcher {
    this._bus.$off(event, callback)
    return this;
  }

  public emit(event: string, ...args: any[]): EventDispatcher {
    this._bus.$emit(event, ...args)
    return this;
  }

}

export default EventDispatcher;
