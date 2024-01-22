<template>
  <div class="card card--details" @click.self="$modal.show('cardDetails-' + card.id)">
    <h3 @click.self="$modal.show('cardDetails-' + card.id)">
      {{ card.title }}

      <a class="btn btn--danger" @click="$emit('delete')">
        <img alt="Delete Card" src="../assets/delete-card.png" width="20" />
      </a>

      <modal :name="('cardDetails-' + card.id)">
        <AddCard :card="card" @cancel="$modal.hide('cardDetails-' + card.id)" @save="update" />
      </modal>
    </h3>
  </div>
</template> 

<script>
import AddCard from './AddCard.vue'
export default {
  name: 'ColumnCard',
  components: {
    AddCard
  },
  props: {
    card: Object,
  },
  data() {
    return {
      showModal: false
    }
  },
  methods: {
    update(cardObj) {
      this.$modal.hide('cardDetails-' + this.card.id)
      this.$emit('updateCard', cardObj)
      this.$forceUpdate()
    }
  }
}
</script>
