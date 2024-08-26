<template>
  <v-app-bar>
    <!-- Бургер-меню, отображается на мобильных устройствах -->
    <v-app-bar-nav-icon v-if="isMobile" @click="toggleDrawer" />

    <!-- Название приложения, скрывается на мобильных устройствах -->
    <v-toolbar-title v-if="!isMobile">My App</v-toolbar-title>

    <!-- Вкладки для больших экранов -->
    <v-spacer v-if="!isMobile"></v-spacer>
    <v-tabs v-if="!isMobile">
      <v-tab to="/">Main</v-tab>
      <v-tab to="/favorites">Favorites</v-tab>
      <v-tab to="/booking">Booking</v-tab>
      <v-tab to="/admin-panel">Admin Panel</v-tab>
    </v-tabs>

    <!-- Выдвижное меню для мобильных устройств -->
    <v-navigation-drawer
      v-model="drawer"
      app
      temporary
      style="height: 400px"
      :location="'top'"
    >
      <v-list>
        <v-list-item to="/">
          <v-list-item-title>Main</v-list-item-title>
        </v-list-item>
        <v-list-item to="/favorites">
          <v-list-item-title>Favorites</v-list-item-title>
        </v-list-item>
        <v-list-item to="/booking">
          <v-list-item-title>Booking</v-list-item-title>
        </v-list-item>
        <v-list-item to="/admin-panel">
          <v-list-item-title>Admin Panel</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </v-app-bar>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useDisplay } from 'vuetify'

const drawer = ref(false)

const { mobile } = useDisplay()
const isMobile = computed(() => mobile.value)

const toggleDrawer = () => {
  drawer.value = !drawer.value
}
</script>

<style scoped></style>
