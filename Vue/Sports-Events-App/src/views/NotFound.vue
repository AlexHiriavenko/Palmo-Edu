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

<style>
.not-found {
  background-color: rgb(37, 50, 57);
}

.v-empty-state.not-found {
  justify-content: start;
  padding-top: 32px;
  min-height: calc(100vh - var(--header-height));
}

.v-empty-state .v-empty-state__headline {
  margin-top: 20px;
  font-size: 40px;
  font-weight: 700;
  color: white;
}

.v-empty-state .v-empty-state__title {
  font-size: 26px;
  font-weight: 700;
  color: white;
}

.v-empty-state .v-empty-state__text {
  font-size: 20px;
  font-weight: 700;
  color: white;
}
</style>
