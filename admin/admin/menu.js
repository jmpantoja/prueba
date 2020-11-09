export default function () {
  const t = this.$t.bind(this)
  const l = this.localePath.bind(this)
  return [
    {
      title: 'Home',
      icon: 'mdi-view-dashboard',
      name: 'Dashboard',
      href: l('index')

    },
    //        {header: 'divider'},
    {
      title: t('menu.vocabulary'),
      icon: 'mdi-file-document',
      name: 'Entries',
      items: [
        {
          title: t('menu.tags'),
          name: 'Tags',
          href: l({
            name: 'data-action-entity',
            params: {
              action: 'list',
              entity: 'entry-tags'
            }
            // query: {
            //   'sort-by': 'name',
            //   'sort-dir': 'ASC',
            //   'page': '1',
            // }
          })
        },
        {
          title: t('menu.entries'),
          name: 'Entries',
          href: l({
            name: 'data-action-entity',
            params: {
              action: 'list',
              entity: 'entries'
            }
          })
        }
      ]
    }
  ]
}
