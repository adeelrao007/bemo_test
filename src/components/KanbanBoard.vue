<template>
  <div>
    <h1>KanbanBoard
      <a class="btn btn--info" @click="showAddColumnForm = true">
        <img alt="Add new Column" src="../assets/add-board.svg" width="20" />
      </a>
    </h1>

    <AddColumn v-if="showAddColumnForm" @cancel="showAddColumnForm = false" @save="saveColumn" />
    <div class="columns">
      <div v-for="(column, index) in columns" v-bind:key="column.id">
        <BoardColumn v-bind:key="('column-' + column.id)" :column="column" :columnIndex="index" @saveCard="saveCard"
          @updateCard="updateCard" @deleteColumn="deleteColumn" @deleteCard="deleteCard" />
      </div>
    </div>
  </div>
</template>

<script>
import store from '../store.js'
// import { updateCard, updateColumns } from '../apis.js'
import BoardColumn from './BoardColumn.vue'
import AddColumn from './AddColumn.vue'
export default {
  name: 'KanbanBoard',
  components: {
    BoardColumn,
    AddColumn
  },
  data() {
    return {
      showAddColumnForm: false,
      columns: store.columns
    }
  },
  methods: {
    saveColumn(columObj) {
      this.columns.push(columObj)
      this.showAddColumnForm = false
    },
    saveCard(data) {
      const columnIndex = this.findColumnIdIndex(data.columnId)
      if (columnIndex >= 0)
        this.columns[columnIndex].cards.push(data.card)
    },
    updateCard(data) {
      const columnIndex = this.findColumnIdIndex(data.columnId)
      const cardIndex = this.findCardIdIndex(columnIndex, data.cardId)
      if (columnIndex >= 0 && cardIndex >= 0) {
        this.columns[columnIndex].cards[cardIndex] = data.card
      }
      this.$forceUpdate()
    },
    deleteColumn(columnId) {
      const columnIndex = this.findColumnIdIndex(columnId)
      if (columnIndex >= 0)
        this.columns.splice(columnIndex, 1)
    },
    deleteCard(data) {
      const columnIndex = this.findColumnIdIndex(data.columnId)
      const cardIndex = this.findCardIdIndex(columnIndex, data.cardId)
      if (columnIndex >= 0 && cardIndex >= 0)
        this.columns[columnIndex].cards.splice(cardIndex, 1)
    },
    findColumnIdIndex(columnId) {
      return this.columns.findIndex((cols) => cols.id === columnId)
    },
    findCardIdIndex(columnIndex, cardId) {
      return this.columns[columnIndex].cards.findIndex((cards) => cards.id === cardId)
    }
  }
}
</script>
