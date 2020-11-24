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
//    {header: 'divider'},

    {
      title: t('admin.example.menu'),
      name: t('admin.example.menu'),
      icon: 'mdi-file-document',
      items: [
        {
          title: t('admin.example.contact.menu'),
          name: t('admin.example.contact.menu'),
          href: l({
            name: 'api-contacts',
            // params: {
            //   action: 'list',
            //   entity: 'contacts'
            // }
          })
        }
      ]
    }
  ]
}
