import Vue from 'vue'
import Element from 'element-ui'
import locale from 'element-ui/lib/locale/lang/es'
import clickoutside from "element-ui/src/utils/clickoutside";

Vue.use(Element, {locale})

Vue.mixin({
  directives: {
    clickoutside
  }
})
