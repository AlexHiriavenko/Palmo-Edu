<template>
  <v-layout>
    <HeaderApp />
    <v-main>
      <LoaderSpinner
        :is-loading="!userStore.isAuthReady"
        :color="'white'"
        :size="70"
      />
      <RouterView v-if="userStore.isAuthReady" />
    </v-main>
  </v-layout>
</template>

<script setup>
import HeaderApp from '@/components/HeaderApp.vue'
import { useUserStore } from './stores/userStore'

const userStore = useUserStore()
</script>
