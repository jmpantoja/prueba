export default {
  api: {
    endpoints: {
      list: {
        path: '/contacts',
        method: 'GET'
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
      fullName: {}
    }
  }
}
