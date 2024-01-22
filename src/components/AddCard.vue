<template>
  <div class="form">
    <form @submit.prevent="saveCard">
      <span v-if="titleRequiredMessage" class="error">Title is required</span>
      <input v-model="title" type="text" class="form__title" name="title" placeholder="Enter title here" value="" />
      <span v-if="descriptionRequiredMessage" class="error">Description is required</span>
      <textarea v-model="description" type="text" class="form__description" name="description"
        placeholder="Enter description here" />
      <input type="submit" name="save_card" class="form__submit" :value="(this.card ? 'Edit' : 'Save')" />
      <a class="btn btn--danger" @click="$emit('cancel')">
        Cancel
      </a>
    </form>
  </div>
</template> 

<script>
export default {
  name: 'AddCard',
  props: {
    card: {
      type: Object,
      default: () => null
    }
  },
  data() {
    return {
      id: (this.card ? this.card.id : ''),
      title: (this.card ? this.card.title : ''),
      titleRequiredMessage: false,
      description: (this.card ? this.card.description : ''),
      descriptionRequiredMessage: false,
    }
  },
  methods: {
    saveCard() {
      if (this.title && this.description) {
        this.titleRequiredMessage = false
        this.descriptionRequiredMessage = false
        const card = {
          id: (this.id ? this.id : this.makeid(5)),
          title: this.title,
          description: this.description
        }
        this.$emit('save', card);
      }
      if (!this.title) {
        this.titleRequiredMessage = true
      }
      if (!this.description) {
        this.descriptionRequiredMessage = true
      }
    },
    makeid(length) {
      let result = ''
      const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
      const charactersLength = characters.length
      let counter = 0
      while (counter < length) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength))
        counter += 1
      }
      return result
    }
  }
}
</script>
