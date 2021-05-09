<template>
  <atn-field :label="label">
    <div class="dual">
      <div class="listbox source">
        <input type="text" @input="filterSource"/>
        <ul>
          <li v-for="(item, key) in source"
              v-if="item.visible"
              :key="key"
              :class="{info: item.highlighted, 'white--text': item.highlighted, rounded: true}"
              @click="toggleHighlight(item)"
              @dblclick="onAppend(item)"
          >
            {{ item.text }}
          </li>
        </ul>
      </div>

      <div class="toolbar">
        <v-btn icon color="info" @click="onAppendAll">
          <v-icon>mdi-chevron-double-right</v-icon>
        </v-btn>

        <v-btn icon color="info" @click="onAppendHighlighted">
          <v-icon>mdi-chevron-right</v-icon>
        </v-btn>

        <v-btn icon color="info" @click="onRemoveHighlighted">
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>

        <v-btn icon color="info" @click="onRemoveAll">
          <v-icon>mdi-chevron-double-left</v-icon>
        </v-btn>
      </div>

      <div class="listbox target">
        <input type="text" @input="filterTarget"/>
        <ul>
          <li v-for="(item, key) in target"
              v-if="item.visible"
              :key="key"
              :class="{info: item.highlighted, 'white--text': item.highlighted, rounded: true}"
              @click="toggleHighlight(item)"
              @dblclick="onRemove(item)"
          >
            {{ item.text }}
          </li>
        </ul>
      </div>
    </div>
  </atn-field>
</template>

<script>
import AtnFieldEntity from "~/plugins/atn/components/field/AtnFieldEntity";
import AtnField from "~/plugins/atn/components/form/AtnField";
import {getPropertyFromItem,} from 'vuetify/lib/util/helpers'


export default {
  name: 'AtnFieldEntityListbox',
  components: {AtnField},
  extends: AtnFieldEntity,
  computed: {
    target() {
      return Object.values(this.items)
        .filter((item) => {
          return item.selected
        })
    },
    targetAndHighlighted() {
      return this.target
        .filter((item) => {
          return item.highlighted
        })
    },
    source() {
      return Object.values(this.items)
        .filter((item) => {
          return !item.selected
        })
    },
    sourceAndHighlighted() {
      return this.source
        .filter((item) => {
          return item.highlighted
        })
    },
  },
  methods: {
    filterSource(event) {
      const data = event.target.value
      Object.values(this.source)
        .forEach((item) => {
          item.visible = item.text.toLowerCase().includes(data.toLowerCase())
          item.highlighted = item.highlighted && item.visible
        })
    },
    filterTarget(event) {
      const data = event.target.value
      Object.values(this.target)
        .forEach((item) => {
          item.visible = item.text.toLowerCase().includes(data.toLowerCase())
          item.highlighted = item.highlighted && item.visible
        })
    },
    toggleHighlight(item) {
      item.highlighted = !item.highlighted
    },
    onAppendHighlighted() {
      this.sourceAndHighlighted.forEach((item) => {
        item.selected = true
        item.highlighted = false
      })
      this.change()
    },
    onAppendAll(item) {
      this.source.forEach((item) => {
        item.selected = true
        item.highlighted = false
      })
      this.change()
    },
    onAppend(item) {
      item.selected = true
      item.highlighted = false

      this.change()
    },
    onRemoveAll(item) {
      this.target.forEach((item) => {
        item.selected = false
        item.highlighted = false
      })
      this.change()
    },
    onRemoveHighlighted() {
      this.targetAndHighlighted.forEach((item) => {
        item.selected = false
        item.highlighted = false
      })
      this.change()
    },
    onRemove(item) {
      item.selected = false
      item.highlighted = false
      this.change()
    },
    change() {
      const data = Object.values(this.target)
        .filter((item) => item)
        .map((item) => {
          return item.value
        })

      if (data.length === this.data.length) {
        return
      }
      this.$emit('input', data)
    }
  },
  watch: {
    data(data) {
      const dataIds = data.map((item) => {
        return item.id
      })

      Object.values(this.items)
        .forEach((item) => {
          item.selected = dataIds.includes(item.id)
        })
    }
  },
  mounted() {
    this.$on('load', (items) => {

      const itemsEntries = items.map((input) => {
        const item = {
          id: input.id,
          text: getPropertyFromItem(input, this.itemText),
          value: input,
          visible: true,
          highlighted: false,
          selected: false
        }

        return [input.id, item]
      })

      this.items = Object.fromEntries(itemsEntries)
    })
  }
}
</script>

<style scoped lang="scss">
@import '~vuetify/src/styles/styles.sass';

.dual {
  display: flex;
  min-height: 300px;
  width: 600px;
  align-items: stretch;

  .listbox {
    flex: 1;
    display: flex;
    flex-direction: column;

    ul, input {
      border: solid 1px #e0e0e0;
      color: #333;
    }

    input {
      margin-bottom: 2px;
      padding: 18px 10px;
    }

    ul {
      flex: 1;
      list-style: none;
      padding-left: 0;
    }

    li {
      padding: 0.5em;
      margin: 4px;
      background-color: #fafafa;
      user-select: none;
    }

    li:last-child {
      margin-bottom: 0;
    }
  }

  .toolbar {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0.8em;
  }
}
</style>
