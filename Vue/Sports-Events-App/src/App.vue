<template>
  <v-layout>
    <HeaderApp />
    <v-main>
      <RouterView />
    </v-main>
  </v-layout>
</template>

<script setup>
import HeaderApp from '@/blocks/HeaderApp.vue'
import { RouterView } from 'vue-router'
</script>
