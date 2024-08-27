<template>
  <v-sheet class="mx-auto" width="300">
    <v-form fast-fail @submit.prevent="currentSubmitMethod">
      <v-card-title class="text-center">{{ formTitle }}</v-card-title>
      <v-text-field
        v-model="email"
        :rules="emailRules"
        label="Email"
        type="email"
        autocomplete="email"
      ></v-text-field>

      <v-text-field
        v-model="password"
        :rules="passwordRules"
        label="Password"
        type="password"
        autocomplete="current-password"
      ></v-text-field>

      <v-btn class="mt-2" type="submit" block>Submit</v-btn>
    </v-form>
  </v-sheet>
</template>

<script>
export default {
  props: {
    currentSubmitMethod: {
      type: Function,
      required: true
    },
    formTitle: {
      type: String,
      required: false
    }
  },
  data: () => ({
    email: '',
    emailRules: [
      (value) => {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        if (emailPattern.test(value)) return true

        return 'Please enter a valid email address.'
      }
    ],
    password: '',
    passwordRules: [
      (value) => {
        if (value?.length >= 6) return true

        return 'Password must be at least 6 characters.'
      }
    ]
  })
}
</script>
