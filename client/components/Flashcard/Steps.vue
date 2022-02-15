<template>
  <el-steps class="flashcard-steps"
            align-center
            :active="step">
    <el-step title="Estudiar"/>
    <el-step title="Comprobar"/>
    <el-step title="Resultados"/>
  </el-steps>

</template>

<script lang="ts">
import {Component, Prop, Vue, Watch} from 'nuxt-property-decorator'
import { Workflow} from "~/types/app";


@Component({
  inheritAttrs: false,
  name: 'FlashcardSteps',
})
export default class extends Vue {
  @Prop({required: true, type: Object as () => Workflow}) workflow!: Workflow

  private workflow_: Workflow = this.workflow

  private get step() {
    return this.workflow_.step;
  }
}
</script>

<style scoped lang="scss">
</style>
