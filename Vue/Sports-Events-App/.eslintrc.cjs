/* eslint-env node */
require('@rushstack/eslint-patch/modern-module-resolution')

module.exports = {
  root: true,
  extends: [
    'plugin:vue/vue3-essential',
    'eslint:recommended',
    '@vue/eslint-config-prettier/skip-formatting'
  ],
  parserOptions: {
    ecmaVersion: 'latest'
  },
  rules: {
    // Требует имена пропсов в стиле camelCase
    'vue/prop-name-casing': ['error', 'camelCase'],

    // Требует emit в стиле camelCase
    'vue/custom-event-name-casing': ['error', 'camelCase'],

    // Запрещает использовать `this` в шаблонах компонентов
    'vue/this-in-template': ['error', 'never'],

    // Запрещает использование нескольких пробелов подряд
    'vue/no-multi-spaces': 'error',

    // Требует определённый порядок тегов `<template>`, `<script>` и `<style>`
    'vue/component-tags-order': [
      'error',
      {
        order: ['template', 'script', 'style']
      }
    ]
  },
  globals: {
    Component: true,
    ComponentPublicInstance: true,
    ComputedRef: true,
    EffectScope: true,
    ExtractDefaultPropTypes: true,
    ExtractPropTypes: true,
    ExtractPublicPropTypes: true,
    InjectionKey: true,
    PropType: true,
    Ref: true,
    VNode: true,
    WritableComputedRef: true,
    acceptHMRUpdate: true,
    computed: true,
    createApp: true,
    createPinia: true,
    customRef: true,
    defineAsyncComponent: true,
    defineComponent: true,
    defineStore: true,
    effectScope: true,
    getActivePinia: true,
    getCurrentInstance: true,
    getCurrentScope: true,
    h: true,
    inject: true,
    isProxy: true,
    isReactive: true,
    isReadonly: true,
    isRef: true,
    mapActions: true,
    mapGetters: true,
    mapState: true,
    mapStores: true,
    mapWritableState: true,
    markRaw: true,
    nextTick: true,
    onActivated: true,
    onBeforeMount: true,
    onBeforeRouteLeave: true,
    onBeforeRouteUpdate: true,
    onBeforeUnmount: true,
    onBeforeUpdate: true,
    onDeactivated: true,
    onErrorCaptured: true,
    onMounted: true,
    onRenderTracked: true,
    onRenderTriggered: true,
    onScopeDispose: true,
    onServerPrefetch: true,
    onUnmounted: true,
    onUpdated: true,
    provide: true,
    reactive: true,
    readonly: true,
    ref: true,
    resolveComponent: true,
    setActivePinia: true,
    setMapStoreSuffix: true,
    shallowReactive: true,
    shallowReadonly: true,
    shallowRef: true,
    storeToRefs: true,
    toRaw: true,
    toRef: true,
    toRefs: true,
    toValue: true,
    triggerRef: true,
    unref: true,
    useAttrs: true,
    useCssModule: true,
    useCssVars: true,
    useLink: true,
    useRoute: true,
    useRouter: true,
    useSlots: true,
    watch: true,
    watchEffect: true,
    watchPostEffect: true,
    watchSyncEffect: true
  }
}
