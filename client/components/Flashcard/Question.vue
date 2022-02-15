<template>
  <el-card class="flashcard-question">
    <div class="flashcard-question__side flashcard-question__question">
      {{ question.question }}
    </div>
    <el-divider/>
    <div class="flashcard-question__side flashcard-question__answer">
      <template v-if="workflow_.is_studing">
        {{ question.answer }}
      </template>
      <template v-else-if="workflow.is_waiting">
        <el-input
          ref="textbox"
          autofocus
          v-model="input" @change="onEnter" suffix-icon=""/>

      </template>
      <template v-else>
        <flashcard-result :question="question" :inputText="input"/>
      </template>
    </div>

  </el-card>
</template>

<script lang="ts">
import {Component, Prop, Vue, Watch} from 'nuxt-property-decorator'
import {Question, State, Workflow} from "~/types/app";
import {ElInput} from "element-ui/types/input";


@Component({
  inheritAttrs: false,
  name: 'FlashcardQuestion',
})
export default class extends Vue {
  @Prop({required: true, type: Object as () => Question}) question!: Question
  @Prop({required: true, type: Object as () => Workflow}) workflow!: Workflow

  private input: String = '';
  private workflow_: Workflow = this.workflow

  @Watch('question')
  private onChange() {
    this.reset();
  }

  private mounted() {
    this.reset()
  }

  private reset() {
    this.input = ''
    this.workflow_.reset();

    if (this.workflow.is_studing) {
      this.$emit('uncover', this.question)
    }

    this.$nextTick(() => {
      this.focus();
    })
  }

  private focus() {
    const textbox = (this.$refs.textbox as ElInput);
    if (!textbox) {
      return
    }
    textbox.focus()
  }

  private onEnter() {
    const success = this.workflow_.answer(this.question, this.input)
    if (success) {
      this.$emit('uncover', this.question)
    }

    this.$emit('answer', success, this.question, this.input)
  }

}
</script>

<style scoped lang="scss">
.flashcard-question__side {
  font-size: 3rem;

}

::v-deep .flashcard-question__answer .el-input__inner,  ::v-deep .flashcard-question__answer .flashcard-result{
  font-size: 3rem;
  padding: 10px;
  height: auto;
}

.flashcard-question__answer {
  color: gray;
}

</style>
