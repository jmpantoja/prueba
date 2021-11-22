export default function ({app}) {
  var redirect = app.$auth.$storage.options.redirect

  for (var key in redirect) {
    redirect[key] = app.localePath(redirect[key])
  }
  app.$auth.$storage.options.redirect = redirect
}
