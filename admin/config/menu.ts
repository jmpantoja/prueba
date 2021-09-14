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
    path: '/data',
    title: 'menu.film_archive',
    icon: 'el-icon-setting',
    children: [
      {
        path: '/data/movies/list',
        title: 'menu.movies',
      },
      {
        path: '/data/genres/list',
        title: 'menu.genres',
      },
      {
        path: '/data/directors/list',
        title: 'menu.directors',
      }
    ]
  },
]

export default menu
