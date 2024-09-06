import { ref, computed } from 'vue'

export function usePagination(items, itemsPerPage = 6) {
  const page = ref(1)
  const totalPages = computed(() =>
    Math.ceil(items.value.length / itemsPerPage)
  )

  const paginatedItems = computed(() => {
    const start = (page.value - 1) * itemsPerPage
    const end = start + itemsPerPage
    return items.value.slice(start, end)
  })

  const handlePageChange = (newPage) => {
    page.value = newPage
  }

  return {
    page,
    paginatedItems,
    totalPages,
    handlePageChange,
    itemsPerPage
  }
}
