import { ref, computed } from 'vue'

export function usePagination(items, itemsPerPage = 10) {
  const page = ref(1)

  const totalPages = computed(() => {
    return Math.ceil(items.length / itemsPerPage)
  })

  const paginatedItems = computed(() => {
    const start = (page.value - 1) * itemsPerPage
    const end = start + itemsPerPage
    return items.slice(start, end)
  })

  function setPage(newPage) {
    page.value = newPage
  }

  return {
    page,
    totalPages,
    paginatedItems,
    setPage,
    itemsPerPage
  }
}
