<template>
  <div class="flashcard-result">
    <p>
      <span
        v-for="(item, key) in given"
        :key="key"
        :class="item.type"
        v-html="item.letters"
      />
    </p>

    <p>
      <span
        v-for="(item, key) in expected"
        :key="key"
        :class="item.type"
        v-html="item.letters"
      />
    </p>

  </div>

</template>

<script lang="ts">
import {Component, Prop, Vue} from 'nuxt-property-decorator'
import {Question, Difference, DiffItem} from "~/types/app";

const diff = require('fast-diff')

@Component({
  inheritAttrs: false,
  name: 'FlashcardResult',
})
export default class extends Vue {
  @Prop({required: true, type: Object as () => Question}) question!: Question
  @Prop({required: true, type: String}) inputText!: String

  private given: DiffItem[] = []
  private expected: DiffItem[] = []

  private mounted() {
    const difference = new Difference(this.question.answer, this.inputText)

    this.given = difference.given
    this.expected = difference.expected
  }

}
</script>

<style scoped lang="scss">
.flashcard-result {
  font-size: 2rem;

  .equal {
    color: #6aaa64;
  }

  .insert {
    color: #E35050FF;
  }

  .delete {
    color: #787c7e;

  }

}

</style>
