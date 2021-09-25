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
  // {
  //   path: '/data/cinema',
  //   title: 'menu.film_archive',
  //   icon: 'el-icon-setting',
  //   children: [
  //     {
  //       path: '/data/cinema/movies/list',
  //       title: 'menu.movies',
  //     },
  //     {
  //       path: '/data/cinema/genres/list',
  //       title: 'menu.genres',
  //     },
  //     {
  //       path: '/data/cinema/directors/list',
  //       title: 'menu.directors',
  //     }
  //   ]
  // },
  {
    path: '/data/music',
    title: 'menu.music',
    icon: 'el-icon-setting',
    children: [
      {
        path: '/data/music/groups/list',
        title: 'menu.music_groups',
      },      {
        path: '/data/music/albums/list',
        title: 'menu.music_albums',
      },
    ]
  },
]

export default menu
