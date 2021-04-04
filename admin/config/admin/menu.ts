import {MenuGroup} from "~/plugins/atn/src";

const menu: MenuGroup[] = [
  {
    text: 'menu.dashboard',
    icon: 'mdi-view-dashboard',
    href: {
      name: 'dashboard'
    }
  },
  {
    text: 'menu.movies',
    icon: 'mdi-file-document',
    items: [
      {
        text: 'menu.movies',
        href: {
          name: 'data-movies'
        }
      },
      {
        text: 'menu.genre',
        href: {
          name: 'data-genres'
        }
      },
    ]
  }
]

export default menu
