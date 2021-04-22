const _ = require("lodash")
export default (data) => {

  const replace = (message, params) => {
    const args = data.extract(params)
    _.each(args, (replacement, pattern) => {
      message = _.replace(message, `{${pattern}}`, replacement)
    })
    return message
  }
  const messages = _.merge(data.defaults, data.messages)
  return _.cloneDeepWith(messages, (value) => {
    if (_.isString(value)) {
      return (params) => {
        return replace(value, params)
      }
    }
  })
}
