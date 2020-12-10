import path from 'path'

export default function ExampleModule(moduleOptions) {

  const options = {
    ...this.options.admin,
    ...moduleOptions
  }



  this.addLayout({
    name: 'dashboard',
    src: path.join(__dirname, 'layouts/dashboard.vue')
  })

  this.addPlugin({
    src: path.join(__dirname, '/plugins/crud/index.js'),
    fileName: 'admin.js',
    options: options
  })

  this.nuxt.hook('ready', async nuxt => {
    console.log('Nuxt is ready')

  })

}

// REQUIRED if publishing the module as npm package
//module.exports.meta = require('./package.json')
