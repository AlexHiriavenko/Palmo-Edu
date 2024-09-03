<template>
  <v-tabs v-model="activeTab">
    <v-tab v-for="route in tabRoutes" :key="route.name" :to="route.path">
      {{ route.meta?.title || route.name }}
    </v-tab>
  </v-tabs>
</template>

<script setup>
import { computed, ref, watch } from 'vue'
import { useRouter } from 'vue-router'

const props = defineProps({
  routes: {
    type: Array,
    required: true
  }
})

const router = useRouter()
const activeTab = ref(null)

// Фильтруем только те маршруты, которые должны отображаться в табах
const tabRoutes = computed(() =>
  props.routes.filter((route) => route.meta?.showInTabs)
)

// Отслеживаем изменения маршрута и устанавливаем активную вкладку только если она есть в tabRoutes
watch(
  () => router.currentRoute.value.path,
  (newPath) => {
    const matchedRoute = tabRoutes.value.find((route) => route.path === newPath)
    activeTab.value = matchedRoute ? matchedRoute.path : null
  },
  { immediate: true }
)
</script>
