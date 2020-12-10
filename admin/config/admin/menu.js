export default [
  {
    text: 'menu.dashboard',
    icon: 'mdi-view-dashboard',
    href: {
      name: 'dashboard'
    }
  },
  {
    text: 'menu.example',
    icon: 'mdi-file-document',
    items: [
      {
        text: 'menu.contact',
        href: {
          name: 'crud',
          params: {
            admin: 'contact'
          }
        }
      }
    ]
  }
]
