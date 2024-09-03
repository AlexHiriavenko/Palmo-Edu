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
        <span>{{ userStore.currentUser?.name || '' }}</span>
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
        :authType="authType"
        v-model:isLoading="isLoading"
      />
    </template>
  </ModalDialog>
</template>

<script setup>
import { useModalStore } from '@/stores/modalStore'
import { useUserStore } from '@/stores/userStore'
import NavBar from '@/components/general/NavBar.vue'
import DropMenu from '@/components/general/DropMenu.vue'
import AuthForm from '@/components/auth/AuthForm.vue'
import LoaderSpinner from '@/components/general/LoaderSpinner.vue'
import AuthResultMessage from '@/components/auth/AuthResultMessage.vue'

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
        { text: 'SignUp', action: 'signup' }
      ]
})

const currentSubmitMethod = ref(null)
const formTitle = ref('')
const isLoading = ref(false)
const authType = ref('')

const authResult = computed(
  () => !isLoading.value && (userStore.isLoggedIn || userStore.authError)
)

const authItemClick = (item) => {
  authType.value = item.action

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
