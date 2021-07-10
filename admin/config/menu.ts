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
    path: '/borrame',
    title: 'menu.borrame',
    icon: 'el-icon-user'
  },
  {
    path: '/data',
    title: 'menu.film_archive',
    icon: 'el-icon-setting',
    children: [
      {
        path: '/data/genres/list',
        title: 'menu.genres',
      }
    ]
  },
]

export default menu
