import Vue from 'vue'
import Element from 'element-ui'
import locale from 'element-ui/lib/locale/lang/es'
import clickoutside from "element-ui/src/utils/clickoutside";

import _ from 'lodash';
Object.defineProperty(Vue.prototype, '$_', { value: _ });

Vue.use(Element, {locale})

Vue.mixin({
  directives: {
    clickoutside
  }
})


