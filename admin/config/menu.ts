type MenuItem = {
  title: string,
  path: string,
  icon?: string,
  roles?: string[],
  children?: MenuItem[],
}

type Menu = MenuItem[]

const menu: Menu = [
  {
    path: '/',
    title: 'menu.dashboard',
    icon: 'el-icon-user'
  },
  {
    path: '/data/vocabulary',
    title: 'menu.vocabulary',
    icon: 'el-icon-setting',
    children: [
      {
        path: '/data/vocabulary/entries/list',
        title: 'menu.entries',
      }
    ]
  },
]

export default menu
