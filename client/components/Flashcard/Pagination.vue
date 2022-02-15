<template>
  <div class="flashcard-pagination">
    <el-button @click="onPrevious" :disabled="pagination.isFirst">
      <el-icon name="arrow-left"></el-icon>
    </el-button>

    <el-button @click="onNext" :disabled="pagination.isLast">
      <el-icon name="arrow-right"></el-icon>
    </el-button>
  </div>
</template>

<script lang="ts">
import {Component, Prop, Vue, Watch} from 'nuxt-property-decorator'
import {Deck, Pagination} from "~/types/app";


@Component({
  inheritAttrs: false,
  name: 'FlashcardPagination',
})
export default class extends Vue {
  @Prop({required: true, type: Object as () => Pagination}) pagination!: Pagination

  private created() {
    window.addEventListener('keydown', this.onKeyDown)
  }

  private destroyed() {
    window.removeEventListener('keydown', this.onKeyDown)
  }

  private onKeyDown(event: KeyboardEvent) {
    const tagName = (event.target as HTMLElement).tagName
    if ('BODY' !== tagName) {
      return
    }

    switch (event.key) {
      case 'ArrowLeft':
        this.onPrevious()
        break;
      case 'ArrowRight':
      case 'Enter':
        this.onNext()
        break;
    }
  }

  private onPrevious(): void {
    this.pagination.previous()
  }

  private onNext(): void {
    this.pagination.next()
  }
}
</script>

<style scoped lang="scss">

.flashcard-pagination {
  margin-top: 1rem;

  .el-button {
    border: none;
    font-size: 2rem;
    margin-left: 0;
    padding: 0.5rem 0;

    &:hover, &:focus {
      background-color: transparent;
    }
  }
}

</style>
