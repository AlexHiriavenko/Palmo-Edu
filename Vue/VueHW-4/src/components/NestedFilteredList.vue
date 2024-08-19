<template>
  <div class="component">
    <h2>Nested Filtered List</h2>
    <h3>
      Countries and Timezones. Filtered by population less than
      {{ populationCriteria.toLocaleString() }}
    </h3>
    <ul class="countries">
      <template
        v-for="country in countries"
        :key="country.id"
      >
        <li v-if="country.population < populationCriteria">
          <strong>{{ country.name }}.</strong>
          Population
          {{ country.population.toLocaleString() }}
          <ul v-if="country.timezones.length">
            <li
              v-for="(timezone, subIndex) in country.timezones"
              :key="subIndex"
            >
              {{ timezone }}
            </li>
          </ul>
        </li>
      </template>
    </ul>
  </div>
</template>

<script>
  import axios from '../axios.js';

  export default {
    name: 'NestedFilteredList',
    data() {
      return {
        countries: [],
        populationCriteria: 10_000_000,
      };
    },
    methods: {
      async getCountries() {
        try {
          const data = await axios.get('all');
          this.countries = data.map((country) => ({
            id: country.name.official,
            name: country.name.common,
            population: country.population,
            timezones: country.timezones || [],
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
  height: 400px;
  overflow-y: auto;
}
</style>
