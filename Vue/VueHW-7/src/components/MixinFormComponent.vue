<template>
  <div>
    <form @submit.prevent="submitForm">
      <div>
        <label for="name">Name:</label>
        <input v-model="formData.name" type="text" id="name" @input="isValidForm = false" />
        <span v-if="errors.name" class="error">{{ errors.name }}</span>
      </div>
      <div>
        <label for="email">Email:</label>
        <input v-model="formData.email" type="text" id="email" @input="isValidForm = false" />
        <span v-if="errors.email" class="error">{{ errors.email }}</span>
      </div>
      <button type="submit">Submit</button>
      <p v-if="isValidForm" class="succecc">Form submitted succeccfully</p>
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
      errors: {},
      isValidForm: false
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
        this.errors = {}
        this.isValidForm = true
        Object.keys(this.formData).forEach((key) => {
          this.formData[key] = ''
        })
      } else {
        this.isValidForm = false
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

.succecc {
  color: green;
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
