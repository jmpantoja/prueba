export default {
  api: {
    endpoints: {
      list: {
        path: '/contacts',
        method: 'GET'
      },
      create: {
        path: '/contacts',
        method: 'POST'
      },
      update: {
        path: '/contacts/{id}',
        method: 'PUT'
      },
      delete: {
        path: '/contacts/{id}',
        method: 'DELETE'
      }
    },
  },
  form: {
    default: {
      fullName: {},
      birthDate: null
    }
  }
}
