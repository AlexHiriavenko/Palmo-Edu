<template>
  <v-sheet class="mx-auto" width="300">
    <v-form ref="form" fast-fail @submit.prevent="onSubmit">
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
import { useAuthFormValidation } from '@/composables/useAuthFormValidation'

const { currentSubmitMethod } = defineProps({
  currentSubmitMethod: {
    type: Function,
    required: true
  },
  formTitle: {
    type: String,
    required: false,
    default: 'Form'
  }
})

const email = ref('')
const password = ref('')
const form = ref(null)

const { emailRules, passwordRules } = useAuthFormValidation()

async function onSubmit() {
  const { valid, errors } = await form.value.validate()

  valid ? currentSubmitMethod() : console.log(errors)
}
</script>
