import {ButtonOptions, Customize, Props} from "~/plugins/atn/src/index";

const _ = require('lodash')

class Button {
  private _props: Props;

  private readonly _slot: string | undefined;
  private readonly _action: string;
  private readonly _text?: string
  private readonly _icon?: string
  private readonly _customize?: Customize
  private readonly _large: boolean;

  public constructor(options: ButtonOptions) {
    this._props = this.initProps(options);
    this._icon = options.icon
    this._text = options.text
    this._slot = options.slot
    this._large = options.large || false

    this._action = options.action
    this._customize = options.customize
  }

  private initProps(options: ButtonOptions) {

    options.tile = options.tile === undefined ? true : options.tile

    const hasTile = options.tile ? true : false
    const hasText = options.text ? true : false

    return {
      tile: hasTile && hasText,
      text: !hasTile && hasText,
      icon: !hasText,
      color: options.color || 'primary'
    }
  }

  public customize(props: Props, params: object): Props {
    if (!this._customize) {
      return props
    }

    this._customize(props, params)
    return props
  }

  public get props(): object {
    return this._props
  }

  public get text(): string | undefined {
    return this._text;
  }

  public get icon(): string | undefined {
    return this._icon;
  }

  public get slot(): string | undefined {
    return this._slot;
  }

  public get large(): boolean {
    return this._large;
  }

  public get action(): string {
    return this._action;
  }
}

export default Button
