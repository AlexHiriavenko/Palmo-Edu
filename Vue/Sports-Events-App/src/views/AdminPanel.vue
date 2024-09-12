<template>
  <v-container fluid class="views">
    <h2 class="text-h3 text-white text-center py-4">Admin Panel</h2>
    <NavBar :tabs="adminPanelTabs" />
    <RouterView />
  </v-container>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import NavBar from '@/components/general/NavBar.vue'

const router = useRouter()
const allRoutes = router.options.routes

const adminPanelRoute = allRoutes.find((route) => route.name === 'admin-panel')
const adminPanelTabs = ref(adminPanelRoute?.children || [])
</script>
