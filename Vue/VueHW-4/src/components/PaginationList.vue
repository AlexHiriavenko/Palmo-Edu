<template>
  <div class="component">
    <h2>Pagination List</h2>
    <h3>Countries Areas.</h3>
    <ul class="countries">
      <li
        v-for="country in paginatedCountries"
        :key="country.id"
      >
        <strong>{{ country.name }}.</strong>
        Area:
        {{ country.area.toLocaleString() }}
      </li>
    </ul>
    <div class="pagination">
      <button
        v-for="page in totalPages"
        :key="page"
        @click="currentPage = page"
        :class="{ active: page === currentPage }"
      >
        {{ page }}
      </button>
    </div>
  </div>
</template>

<script>
  import axios from '../axios.js';

  export default {
    name: 'PaginationList',
    data() {
      return {
        countries: [],
        currentPage: 1,
        itemsPerPage: 10,
      };
    },
    computed: {
      paginatedCountries() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = start + this.itemsPerPage;
        return this.countries.slice(start, end);
      },
      totalPages() {
        return Math.ceil(this.countries.length / this.itemsPerPage);
      },
    },
    methods: {
      async getCountries() {
        try {
          const data = await axios.get('all');
          this.countries = data.map((country) => ({
            id: country.name.official,
            name: country.name.common,
            area: country.area,
          }));
        } catch (error) {
          console.error('Ошибка при получении данных:', error);
          this.countries = [];
        }
      },
    },
    mounted() {
      this.getCountries();
    },
  };
</script>

<style scoped>
  h2 {
  margin-bottom: 20px;
}

ul {
  list-style-type: none;
  padding-left: 0;
}

li {
  margin-bottom: 10px;
}

li > ul {
  margin-top: 5px;
  margin-left: 20px;
}

.countries {
  height: 300px;
  overflow-y: auto;
}

.pagination {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.pagination button {
  padding: 5px 10px;
  cursor: pointer;
  min-width: 40px;
}

.pagination button.active {
  font-weight: bold;
  background-color: orangered;
}
</style>
