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
        text: 'menu.contacts',
        href: {
          name: 'data-contacts'
        }
      },
      {
        text: 'menu.friends',
        href: {
          name: 'data-friends'
        }
      }
    ]
  }
]
