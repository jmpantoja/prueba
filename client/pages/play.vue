<template>
  <section class="play">
    <flashcard-steps :workflow="workflow"/>
    <flashcard-score v-if="workflow.is_finalized" :deck="deck"/>
    <flashcard-deck v-else :deck="deck" @answer="onAnswer"/>

  </section>
</template>

<script lang="ts">
import {Component, Vue} from 'nuxt-property-decorator'
import {mapActions, mapGetters} from "vuex";
import {Deck, Question, Step, Workflow} from "~/types/app";

const diff = require("fast-diff")


@Component({
  name: 'Play',
  computed: mapGetters({
    'deck': 'questions/deck'
  }),
  methods: mapActions({
    'load': 'questions/load',
    'solve': 'questions/solve',
  })

})
export default class extends Vue {
  private deck!: Deck
  private load!: () => void
  private solve!: (pp: object, aa: string) => void
  private step: Step = Step.STUDY

  private async fetch() {
    this.load()
  }

  private get workflow(): Workflow {
    return this.deck.workflow
  }

  public onAnswer(success: boolean, question: Question, input: string) {
    this.solve(question, input);
  }

}
</script>

<style scoped lang="scss">

.play {
  height: 100%;
}

.flashcard-steps {
  margin-bottom: 3rem;
}

</style>


