type RouteMeta = {
  admin: string,
  roles?: string[]
  action: string
  components: { [key: string]: string },
}

export {
  RouteMeta
}
