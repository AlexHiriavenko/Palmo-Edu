<template>
  <v-app-bar class="app-header" color="primary" prominent>
    <v-toolbar-title v-if="$vuetify.display.mdAndUp">
      Sports Events App
    </v-toolbar-title>

    <NavBar v-if="$vuetify.display.mdAndUp" :routes="filteredRoutes" />

    <DropMenu
      v-if="$vuetify.display.smAndDown"
      :items="filteredRoutes"
      @itemClick="navItemClick"
    />

    <v-spacer></v-spacer>

    <DropMenu :items="authItems" @itemClick="authItemClick">
      <template #menuActivator="{ props }">
        <v-btn icon="mdi-account" variant="text" v-bind="props"></v-btn>
      </template>
    </DropMenu>
  </v-app-bar>

  <ModalDialog v-if="modalStore.isOpen">
    <template #modal-content>
      <LoaderSpinner :isLoading="isLoading" />
      <AuthResultMessage v-if="authResult" />
      <AuthForm
        v-else
        v-show="!isLoading"
        :currentSubmitMethod="currentSubmitMethod"
        :form-title="formTitle"
        v-model:isLoading="isLoading"
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
import DropMenu from '@/components/DropMenu.vue'
import AuthForm from '@/components/AuthForm.vue'
import LoaderSpinner from '@/components/LoaderSpinner.vue'
import AuthResultMessage from '@/components/AuthResultMessage.vue'

const modalStore = useModalStore()
const userStore = useUserStore()
const router = useRouter()

const filteredRoutes = computed(() => {
  return router.options.routes
    .filter((route) => route.meta?.showInTabs)
    .map((route) => ({
      ...route,
      text: route.meta?.title
    }))
})

const navItemClick = (item) => router.push({ name: item.name })

const authItems = computed(() => {
  return userStore.isLoggedIn
    ? [{ text: 'Logout', action: 'logout' }]
    : [
        { text: 'Login', action: 'login' },
        { text: 'Sign Up', action: 'signup' }
      ]
})

const currentSubmitMethod = ref(null)
const formTitle = ref('')
const isLoading = ref(false)
const authResult = computed(
  () => !isLoading.value && (userStore.isLoggedIn || userStore.authError)
)

const authItemClick = (item) => {
  if (item.action === 'login') {
    currentSubmitMethod.value = userStore.login
    formTitle.value = 'LogIn Form'
    modalStore.openModal()
  }

  if (item.action === 'signup') {
    currentSubmitMethod.value = userStore.signup
    formTitle.value = 'SignUp Form'
    modalStore.openModal()
  }

  if (item.action === 'logout') {
    userStore.logout()
  }
}
</script>
