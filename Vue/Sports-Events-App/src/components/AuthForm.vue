<template>
  <v-sheet class="mx-auto" width="300">
    <v-form fast-fail @submit.prevent="currentSubmitMethod">
      <v-card-title v-if="formTitle" class="text-center">
        {{ formTitle }}
      </v-card-title>

      <v-text-field
        v-model.trim="email"
        :rules="emailRules"
        label="Email"
        type="email"
        autocomplete="email"
      ></v-text-field>

      <v-text-field
        v-model.trim="password"
        :rules="passwordRules"
        label="Password"
        type="password"
        autocomplete="current-password"
      ></v-text-field>

      <v-btn class="mt-2" type="submit" block>Submit</v-btn>
    </v-form>
  </v-sheet>
</template>

<script setup>
// Props
defineProps({
  currentSubmitMethod: {
    type: Function,
    required: true
  },
  formTitle: {
    type: String,
    required: false
  }
})

const email = ref('')
const password = ref('')

const emailRules = [
  (value) => {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    return emailPattern.test(value) || 'Please enter a valid email address.'
  }
]

const passwordRules = [
  (value) => {
    return value?.length >= 6 || 'Password must be at least 6 characters.'
  }
]
</script>
