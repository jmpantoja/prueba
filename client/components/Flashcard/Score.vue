<template>
  <div class="flashcard-score__wrapper">
    <div class="flashcard-score">
      <span>{{ success }}</span>
      /
      <span>{{ total }}</span>
    </div>

    <el-button
      type="success"
      class="button-back"
      @click="back">
      Volver
    </el-button>


  </div>
</template>

<script lang="ts">
import {Component, Prop, Vue} from 'nuxt-property-decorator'
import {Deck, Score} from "~/types/app";

@Component({
  inheritAttrs: false,
  name: 'FlashcardScore',
})
export default class extends Vue {
  @Prop({required: true, type: Object as () => Deck}) deck!: Deck

  private deck_: Deck = this.deck

  private get score(): Score {
    return this.deck_.score
  }

  private get success(): number {
    return this.score.success
  }

  private get total(): number {
    return this.score.total
  }

  public back(): void {
    this.deck_.resume()
  }

}
</script>

<style scoped lang="scss">

.flashcard-score {
  font-size: 5rem;
  display: flex;
  gap: 1rem;

  margin-bottom: 1rem;
  border: solid 1px #c0c4cc;

  justify-content: center;
  align-items: center;

  &:after {
    content: "";
    padding-top: 50%;
    //padding-bottom: 50%;
  }

}

.button-back {
  float: right;
}

</style>
