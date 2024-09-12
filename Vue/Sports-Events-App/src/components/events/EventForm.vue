<template>
  <v-sheet class="mx-auto" width="400">
    <v-form ref="form" fast-fail @submit.prevent="onSubmit" class="px-3 py-3">
      <v-card-title class="text-center">
        {{ formTitle }}
      </v-card-title>

      <v-text-field
        v-model.trim="formData.name"
        :rules="nameRules"
        label="Event Name"
        type="text"
        autocomplete="off"
      ></v-text-field>

      <v-menu>
        <template v-slot:activator="{ props }">
          <v-text-field
            v-bind="props"
            :model-value="formattedDate"
            :rules="dateTimeRules"
            label="Event Date"
            readonly
          >
          </v-text-field>
        </template>

        <v-date-picker
          v-model="formData.date"
          label="Event Date"
          full-width
        ></v-date-picker>
      </v-menu>

      <v-text-field
        v-model="formData.time"
        label="Event Time"
        type="time"
        autocomplete="off"
      ></v-text-field>

      <v-select
        v-model="formData.category"
        :items="categories"
        :rules="categoryRules"
        label="Category"
        autocomplete="off"
      ></v-select>

      <v-text-field
        v-model.trim="formData.location"
        :rules="locationRules"
        label="Location"
        type="text"
        autocomplete="off"
      ></v-text-field>

      <v-text-field
        v-model.number="formData.price"
        :rules="priceRules"
        label="Price"
        type="number"
        autocomplete="off"
      ></v-text-field>

      <v-btn class="mt-2" type="submit" block>Submit</v-btn>
    </v-form>
  </v-sheet>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useEventFormValidation } from '@/composables/useEventFormValidation'
import { useEventsStore } from '@/stores/eventsStore'

const eventStore = useEventsStore()

const formTitle = 'Create Event'

const formData = ref({
  name: '',
  date: null,
  time: null,
  dateTime: null,
  category: '',
  location: '',
  price: null,
  occupiedSeats: []
})

const form = ref(null)

const {
  nameRules,
  categoryRules,
  locationRules,
  priceRules,
  categories,
  dateTimeRules
} = useEventFormValidation()

const formattedDate = computed(() => formatDate(formData.value.date))

function formatDate(date) {
  if (!date) return ''
  const options = { year: 'numeric', month: 'long', day: 'numeric' }
  return new Date(date).toLocaleDateString('en-US', options)
}

async function onSubmit() {
  const { valid } = await form.value.validate()

  if (valid) {
    try {
      formData.value.dateTime = combineDateAndTime(
        formData.value.date,
        formData.value.time
      )
      delete formData.value.date
      delete formData.value.time

      eventStore.addEvent(formData.value)
      resetForm()
    } catch (error) {
      console.error('Error during submission:', error)
    }
  }
}

function combineDateAndTime(date, time) {
  if (!date || !time) return null

  const [hours, minutes] = time.split(':')
  const combinedDate = new Date(date)
  combinedDate.setHours(hours)
  combinedDate.setMinutes(minutes)
  combinedDate.setSeconds(0)

  return combinedDate.toISOString()
}

function resetForm() {
  formData.value = {
    name: '',
    date: null,
    time: null,
    dateTime: null,
    category: '',
    location: '',
    price: null,
    occupiedSeats: []
  }
  form.value.resetValidation()
}
</script>
