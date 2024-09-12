<template>
  <v-tabs v-model="activeTab" align-tabs="center">
    <v-tab
      v-for="route in tabs"
      :key="route.name"
      :to="{ name: route.name }"
      class="text-white"
    >
      {{ route.meta?.title || route.name }}
    </v-tab>
  </v-tabs>
</template>

<script setup>
const props = defineProps({
  tabs: {
    type: Array,
    required: true
  }
})

const router = useRouter()
const activeTab = ref(null)

// Функция для определения активной вкладки
const getActiveTab = (currentPath) => {
  // Проверяем, есть ли совпадение текущего пути с каким-либо путем в tabs
  const matchedRoute = props.tabs.find((route) =>
    currentPath.includes(route.path)
  )
  return matchedRoute ? matchedRoute.path : null
}

// Следим за изменением пути и обновляем активную вкладку
watch(
  () => router.currentRoute.value.path,
  (newPath) => {
    activeTab.value = getActiveTab(newPath)
    if (activeTab.value === null) {
      nextTick(() => (activeTab.value = null))
    }
  },
  { immediate: true }
)
</script>
