<template>
  <v-empty-state
    class="not-found"
    :headline="isAuthRequired ? 'Authorization Required' : 'Whoops, 404'"
    :title="
      isAuthRequired ? 'Please sign in to access this page' : 'Page not found'
    "
    :text="
      isAuthRequired
        ? 'You need to log in to view this content'
        : 'The page you were looking for does not exist'
    "
    :image="image"
    action-text="Back to Home Page"
    @click:action="redirectToHome"
  ></v-empty-state>
</template>

<script setup>
import icon404 from '@/assets/imgs/icon404.png'
import authImg from '@/assets/imgs/auth-req.webp'
import router from '@/router'
import { computed } from 'vue'

const route = useRoute()

const isAuthRequired = computed(() => route.name === 'auth-required')
const image = computed(() => (isAuthRequired.value ? authImg : icon404))

function redirectToHome() {
  router.push({ name: 'home' })
}
</script>
