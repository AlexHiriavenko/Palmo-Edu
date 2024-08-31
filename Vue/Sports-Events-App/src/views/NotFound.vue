<template>
  <v-empty-state
    class="not-found"
    headline="Whoops, 404"
    title="Page not found"
    text="The page you were looking for does not exist"
    :image="icon404"
    action-text="Back to Home Page"
    @click:action="redirectToHome"
  ></v-empty-state>
</template>

<script setup>
import icon404 from '@/assets/imgs/icon404.png'
import router from '@/router'

function redirectToHome() {
  router.push({ name: 'home' })
}
</script>
