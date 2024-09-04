<template>
  <v-card class="v-card-custom mx-auto" elevation="10">
    <v-card-text class="font-weight-bold text-center" style="padding: 6px">
      Category: <span class="text-blue-darken-1"> {{ event.category }}</span>
    </v-card-text>
    <v-card-title
      class="text-center font-weight-bold wrap-text"
      style="cursor: default"
    >
      {{ event.name }}
      <v-tooltip activator="parent" location="top">{{ event.name }}</v-tooltip>
    </v-card-title>
    <v-card-subtitle class="font-weight-bold">
      Price: {{ event.price }}
    </v-card-subtitle>
    <v-card-text class="font-weight-bold">
      Location: {{ event.location }}
    </v-card-text>
    <v-card-text v-formatdate="event.dateTime" class="font-weight-bold">
      Date:
    </v-card-text>
    <v-card-actions class="justify-center">
      <v-btn
        @click="goToEventDetails"
        color="primary"
        text="More Details"
        class="font-weight-bold"
      />
      <v-btn @click="toggleFavorite" :color="buttonColor">
        <v-tooltip activator="parent" location="top"
          >add to Favorites</v-tooltip
        >
        <v-icon icon="mdi-heart"></v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>

  <!-- <ModalDialog>
    <template #modal-content>
      <v-card-text>You need to LogIn</v-card-text>
      <v-btn @click="modalStore.closeModal">OK</v-btn>
    </template>
  </ModalDialog> -->
</template>

<script setup>
import { useRouter } from 'vue-router'
import { useUserStore } from '@/stores/userStore'
import { useModalStore } from '@/stores/modalStore'

const router = useRouter()
const modalStore = useModalStore()

const props = defineProps({
  event: {
    type: Object,
    required: true
  }
})

function goToEventDetails() {
  router.push({ name: 'event-details', params: { id: props.event.id } })
}

const userStore = useUserStore()

const isFavorite = computed(
  () => userStore.currentUser?.favoriteEvents?.includes(props.event.id) ?? false
)
const buttonColor = computed(() =>
  isFavorite.value ? 'orange-lighten-1' : 'brown-lighten-4'
)

function toggleFavorite() {
  if (!userStore.isLoggedIn) {
    modalStore.openModal()
  }
  userStore.toggleFavorite(props.event.id)
}
</script>
