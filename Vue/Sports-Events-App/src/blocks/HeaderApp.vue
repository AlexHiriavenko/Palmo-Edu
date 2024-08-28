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

    <DropMenu :items="menuItems" @itemClick="handleMenuClick">
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

  <ModalDialog v-if="modalStore.isOpen">
    <template #modal-content>
      <AuthForm
        :currentSubmitMethod="currentSubmitMethod"
        :form-title="formTitle"
      />
    </template>
  </ModalDialog>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useModalStore } from '@/stores/modalStore'
import NavBar from '@/components/NavBar.vue'
import NavBurger from '@/components/NavBurger.vue'
import DropMenu from '@/components/DropMenu.vue'
import AuthForm from '@/components/AuthForm.vue'

const modalStore = useModalStore()

const openModal = () => {
  modalStore.openModal()
}

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

// Определяем методы для логина и регистрации
const loginMethod = () => {
  console.log('login')
  modalStore.closeModal()
}

const signupMethod = () => {
  console.log('signup')
  modalStore.closeModal()
}

// Переменная для текущего метода отправки формы
const currentSubmitMethod = ref(null)
const formTitle = ref('')

const handleMenuClick = (item) => {
  switch (item.action) {
    case 'login':
      currentSubmitMethod.value = loginMethod
      formTitle.value = 'Log In'
      openModal()
      break
    case 'signup':
      currentSubmitMethod.value = signupMethod
      formTitle.value = 'Sign Up'
      openModal()
      break
    case 'logout':
      console.log('Logout')
      break
    default:
      console.log('Unknown action')
  }
}
</script>

<style>
.app-header .v-toolbar__content {
  padding-bottom: 6px;
}
</style>
