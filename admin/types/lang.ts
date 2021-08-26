import {MessageContext} from "vue-i18n";

type StringLike = string | ((params: MessageContext) => string)

type AdminTranslation = {

  toolbar: {
    list: StringLike,
    edit: StringLike,
    create: StringLike,
    delete: StringLike,
  },
  filters: { [key: string]: StringLike },
  columns: { [key: string]: StringLike },
  form: { [key: string]: StringLike },
  message: {
    delete_confirmation: StringLike
  },
  flash: {
    save: StringLike,
    delete: StringLike,
    error: StringLike,
  }
}

type Translation = {
  profile: {
    profile: StringLike,
    logout: StringLike
  },
  lang: {
    es: StringLike,
    en: StringLike,
  },
  filters: {
    equals: StringLike,
    contains: StringLike,
    begins: StringLike,
    ends: StringLike,
  },
  buttons: {
    reset: StringLike,
    filter: StringLike,
    save: StringLike
    back: StringLike,
    yes_delete: StringLike
  },
  menu: { [key: string]: StringLike },
  admin: { [key: string]: AdminTranslation }
}

export {
  Translation,
  AdminTranslation
}
