import {Api} from "~/src/Api";

type Entity = {
  id: string | null
}

type Dataset = {
  items: Entity[],
  totalItems: number
}

export {
  Api,
  Dataset,
  Entity
}
