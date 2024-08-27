<template>
  <v-app-bar class="app-header" color="primary" prominent>
    <v-toolbar-title v-if="$vuetify.display.mdAndUp">
      Sports Events App
    </v-toolbar-title>

    <v-app-bar-nav-icon
      v-if="$vuetify.display.smAndDown"
      variant="text"
      @click.stop="toggleDrawer"
    ></v-app-bar-nav-icon>

    <NavBar :routes="filteredRoutes" v-if="$vuetify.display.mdAndUp" />

    <v-spacer></v-spacer>

    <DropMenu :items="menuItems" @item-click="handleMenuClick">
      <template #activator="{ props }">
        <v-btn icon="mdi-account" variant="text" v-bind="props"></v-btn>
      </template>
    </DropMenu>
  </v-app-bar>

  <NavBurger
    :routes="filteredRoutes"
    :modelValue="drawer"
    @update:modelValue="drawer = $event"
  />
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import NavBar from '@/components/NavBar.vue'
import NavBurger from '@/components/NavBurger.vue'
import DropMenu from '@/components/DropMenu.vue'

const drawer = ref(false)

const router = useRouter()
const filteredRoutes = computed(() => {
  return router.options.routes.filter((route) => route.meta?.showInTabs)
})

const toggleDrawer = () => {
  drawer.value = !drawer.value
}

const menuItems = ref([
  { text: 'Login', action: 'login' },
  { text: 'Sign Up', action: 'signup' },
  { text: 'Logout', action: 'logout' }
])

const handleMenuClick = (item) => {
  switch (item.action) {
    case 'login':
      console.log('Login')
      break
    case 'signup':
      console.log('Sign Up')
      break
    case 'logout':
      console.log('Logout')
      break
    default:
      console.log('Unknown action')
  }
}
</script>
