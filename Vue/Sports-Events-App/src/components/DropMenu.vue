<template>
  <v-menu>
    <template #activator="{ props }">
      <slot>
        <v-btn icon="mdi-account" variant="text" v-bind="props"></v-btn>
      </slot>
    </template>
    <v-list>
      <v-list-item
        v-for="(item, index) in items"
        :key="index"
        @click="handleClick(item)"
      >
        <v-list-item-title>{{ item.text }}</v-list-item-title>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      required: true
    }
  },
  methods: {
    handleClick(item) {
      this.$emit('itemClick', item)
    }
  }
}
</script>
