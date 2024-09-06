<template>
  <v-tabs v-model="activeTab">
    <v-tab v-for="route in tabs" :key="route.name" :to="route.path">
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

// активная вкладка только если она есть в tabs
watch(
  () => router.currentRoute.value.path,
  (newPath) => {
    const matchedRoute = props.tabs.find((route) => route.path === newPath)
    activeTab.value = matchedRoute ? matchedRoute.path : null
  },
  { immediate: true }
)
</script>
