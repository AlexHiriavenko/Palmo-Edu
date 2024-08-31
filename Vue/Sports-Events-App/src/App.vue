<template>
  <v-layout>
    <HeaderApp />
    <v-main>
      <RouterView />
    </v-main>
  </v-layout>
</template>

<script setup>
import HeaderApp from '@/components/HeaderApp.vue'
</script>
