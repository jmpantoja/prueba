export default function ({$axios, $notifier}) {

  $axios.onResponse(response => {
    const data = response.data;

    if (data['@type'] === 'hydra:Collection') {
      return {
        data: {
          success: true,
          total: data['hydra:totalItems'],
          items: data['hydra:member'],
        }
      }
    }

    if (data['@context']) {
      delete data['@type']
      delete data['@context']

      return {
        data: {
          success: true,
          item: data,
        }
      }
    }

    return response

  })

  $axios.onError(error => {
    console.log(error.response)

    $notifier.fail('notifier.failed', error.response.statusText)
    return {
      data: {
        success: false,
        code: parseInt(error.response && error.response.status),
      }
    }
  })
}
