<template>
  <div class="column column--details">
    <h2>
      {{ column.title }}
      <a class="btn btn--danger" @click="$emit('deleteColumn', column.id)">
        <img alt="Delete Column" src="../assets/delete-column.png" width="20" />
      </a>
    </h2>
    <a class="btn btn--info" @click="showAddCardForm = true">
      <img alt="Add new Card" src="../assets/add-card-plus.svg" width="20" />
    </a>
    <AddCard v-if="showAddCardForm" @cancel="showAddCardForm = false" @save="saveCard" />
    <draggable v-model="columnCardsList" group="cards" @change="log">
      <ColumnCard v-for="(card) in columnCards" :card="card" :cardId="card.id" v-bind:key="('card-' + card.id)"
        @updateCard="updateCard" @delete="deleteCard(card.id)" />
    </draggable>
  </div>
</template>

<script>
import draggable from "vuedraggable";
import ColumnCard from './ColumnCard.vue'
import AddCard from './AddCard.vue'
export default {
  name: 'BoardColumn',
  components: {
    ColumnCard,
    AddCard,
    draggable
  },
  props: {
    column: Object,
  },
  data() {
    return {
      showAddCardForm: false,
      columnCards: this.column.cards,
      columnCardsList: this.cardsList()
    }
  },
  methods: {
    cardsList: function () {
      return this.column.cards.map(function (card) {
        return { name: card.title, id: card.id }
      });
    },
    saveCard(cardObj) {
      this.showAddCardForm = false
      this.$emit('saveCard', { columnId: this.column.id, card: cardObj })
    },
    updateCard(card) {
      this.$emit('updateCard', { columnId: this.column.id, cardId: card.id, card: card })
      this.$forceUpdate()
    },
    deleteCard(cardId) {
      this.$emit('deleteCard', { columnId: this.column.id, cardId: cardId })
    },
    add: function () {
      this.list.push({ name: "Juan" });
    },
    replace: function () {
      this.list = [{ name: "Edgard" }];
    },
    clone: function (el) {
      return {
        name: el.name + " cloned"
      };
    },
    log: function (evt) {
      console.log(evt, this.columnCardsList);
    }
  }
}
</script>
