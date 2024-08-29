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
      <LoaderSpinner v-if="userStore.isLoading" />
      <AuthResultMessage
        v-else-if="userStore.isLoggedIn || userStore.authError"
      />
      <AuthForm
        v-else
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
import { useUserStore } from '@/stores/userStore'
import NavBar from '@/components/NavBar.vue'
import NavBurger from '@/components/NavBurger.vue'
import DropMenu from '@/components/DropMenu.vue'
import AuthForm from '@/components/AuthForm.vue'
import LoaderSpinner from '@/components/LoaderSpinner.vue'
import AuthResultMessage from '@/components/AuthResultMessage.vue'

const modalStore = useModalStore()
const userStore = useUserStore()

const drawer = ref(false)

const router = useRouter()
const filteredRoutes = computed(() => {
  return router.options.routes.filter((route) => route.meta?.showInTabs)
})

const toggleDrawer = () => {
  drawer.value = !drawer.value
}

const menuItems = computed(() => {
  return userStore.isLoggedIn
    ? [{ text: 'Logout', action: 'logout' }]
    : [
        { text: 'Login', action: 'login' },
        { text: 'Sign Up', action: 'signup' }
      ]
})

const currentSubmitMethod = ref(null)
const formTitle = ref('')

const handleMenuClick = (item) => {
  switch (item.action) {
    case 'login':
      currentSubmitMethod.value = userStore.login
      formTitle.value = 'LogIn Form'
      modalStore.openModal()
      break
    case 'signup':
      currentSubmitMethod.value = userStore.signup
      formTitle.value = 'SignUp Form'
      modalStore.openModal()
      break
    case 'logout':
      userStore.logout()
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
