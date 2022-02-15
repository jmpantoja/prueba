<template>
  <div class="flashcard-deck">
    <flashcard-toolbar :settings="settings"/>
    <flashcard-question
      :question="question"
      :workflow="workflow"
      @uncover="uncover"
      @answer="$listeners.answer"
    />
    <flashcard-pagination :pagination="pagination"/>

    <el-button
      type="primary"
      class="button-advance"
      @click="advance">
      OK
    </el-button>

  </div>
</template>

<script lang="ts">
import {Component, Prop, Vue} from 'nuxt-property-decorator'
import {Deck, Pagination, Question, Settings, Step, Workflow} from "~/types/app";

@Component({
  inheritAttrs: false,
  name: 'FlashcardDeck',
})
export default class extends Vue {
  @Prop({required: true, type: Object as () => Deck}) deck!: Deck

  private deck_: Deck = this.deck

  private get question(): Question {
    return this.deck_.current;
  }

  private get pagination(): Pagination {
    return this.deck_.pagination;
  }

  private get settings(): Settings {
    return this.deck_.settings;
  }

  private get workflow(): Workflow {
    return this.deck_.workflow;
  }

  private advance() {
    this.deck_.advance()
  }

  private uncover(question: Question) {
    if (this.settings.audio) {
      question.speak()
    }
  }


}
</script>

<style scoped lang="scss">

.flashcard-toolbar {
  margin-bottom: 0.5rem;
}

.flashcard-pagination {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 1.5rem;
}

.button-advance {
  float: right;
}

</style>
