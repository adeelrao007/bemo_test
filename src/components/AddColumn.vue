<template>
  <div class="form">
    <form @submit.prevent="saveColumn">
      <span v-if="titleRequiredMessage" class="error">Title is required</span>
      <input v-model="title" type="text" class="form__title" name="title" placeholder="Enter title here" />
      <input type="submit" name="save_column" class="form__submit" value="Save" />
      <a class="btn btn--danger" @click="$emit('cancel')">
        Cancel
      </a>
    </form>
  </div>
</template> 

<script>
export default {
  name: 'AddColumn',
  data() {
    return {
      title: '',
      titleRequiredMessage: false,
    }
  },
  methods: {
    saveColumn() {
      if (this.title) {
        this.titleRequiredMessage = false
        const column = {
          title: this.title,
          cards: []
        }
        this.$emit('save', column);
      } else {
        this.titleRequiredMessage = true
      }
    }
  }
}
</script>
