<template>
  <v-empty-state
    class="not-found"
    :headline="currentMessages.headline"
    :title="currentMessages.title"
    :text="currentMessages.text"
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
import { useRoute } from 'vue-router'

const route = useRoute()

const messages = {
  'auth-required': {
    headline: 'Authorization Required',
    title: 'Please sign in to access this page',
    text: 'You need to log in to view this content'
  },
  'admin-required': {
    headline: 'Admin Access Required',
    title: 'Admin rights are needed to access this page',
    text: 'You need to have admin rights to view this content'
  },
  'not-found': {
    headline: 'Whoops, 404',
    title: 'Page not found',
    text: 'The page you were looking for does not exist'
  }
}

const currentMessages = computed(
  () => messages[route.name] || messages['not-found']
)

const image = computed(() =>
  route.name === 'auth-required' ? authImg : icon404
)

function redirectToHome() {
  router.push({ name: 'home' })
}
</script>
