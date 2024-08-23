<template>
  <div>
    <form @submit.prevent="submitForm">
      <div>
        <label for="name">Name:</label>
        <input v-model="formData.name" type="text" id="name" />
        <span v-if="errors.name" class="error">{{ errors.name }}</span>
      </div>
      <div>
        <label for="email">Email:</label>
        <input v-model="formData.email" type="email" id="email" />
        <span v-if="errors.email" class="error">{{ errors.email }}</span>
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'MixinFormComponent',
  data() {
    return {
      formData: {
        name: '',
        email: ''
      },
      errors: {}
    }
  },
  methods: {
    submitForm() {
      const validationRules = {
        name: [
          (value) => !!value || 'Name is required',
          (value) => value.length >= 3 || 'Name must be at least 3 characters long'
        ],
        email: [
          (value) => !!value || 'Email is required',
          (value) => /^\S+@\S+\.\S+$/.test(value) || 'Email must be valid'
        ]
      }
      const result = this.validateForm(this.formData, validationRules)
      if (result === true) {
        alert('Form is valid!')
      } else {
        this.errors = result
      }
    }
  }
}
</script>

<style scoped>
.error {
  color: red;
}

form {
  padding: 16px;
  background-color: azure;
  display: flex;
  flex-direction: column;
  gap: 8px;
  align-items: center;
}

span {
  display: block;
}
</style>
