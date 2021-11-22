<template>
  <div class="shortcut">
    <div class="shortcut__content">
      <span class="icon el-icon-phone"/>
      <span class="title">
        <slot name="default">
      {{ $t('shortcut.words') }}
        </slot>
      </span>

    </div>
  </div>
</template>

<script>
import {Component, Vue} from 'nuxt-property-decorator'
import {mapGetters} from "vuex";

@Component({
  inheritAttrs: false,
  name: 'Shortcut',
})
export default class extends Vue {

}

</script>

<style scoped lang="scss">

.shortcut {
  position: relative;
  width: 100%;
  background-color: white;
  border: $--border;

  box-shadow: $--shadow;

  .shortcut__content {
    height: 100%;
    width: 100%;

    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    //flex-wrap: wrap;
    //justify-content: center;

    //align-content: center;

  }

  .icon {
    font-size: 2rem;
    margin-bottom: 0.8rem;
  }

  .title {
    font-size: 0.95rem;
  }

  &::before {
    content: '';
    display: block;
    padding: 50%;
  }
}

</style>
