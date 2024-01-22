<template>
  <div>
    <KanbanBoard class="board" />
  </div>
</template>

<script>
import KanbanBoard from './components/KanbanBoard.vue'

export default {
  name: 'App',
  components: {
    KanbanBoard
  }
}
</script>
<style lang="scss" scoped>
@import './assets/styles.scss'
</style>
