<template>
  <div>
    <h2>Countries and Subregions</h2>
    <ul>
      <li
        v-for="(country, index) in countries"
        :key="index"
      >
        {{ country.name }}
        <ul v-if="country.timezones?.length">
          <li
            v-for="(timezone, subIndex) in country.timezones"
            :key="subIndex"
          >
            {{ timezone }}
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<script>
  import axios from '../axios.js';

  export default {
    name: 'NestedList',
    data() {
      return {
        countries: [],
      };
    },
    methods: {
      async getCountries() {
        const data = await axios.get('all');
        this.countries = data.map((country) => ({
          name: country.name.common,
          timezones: country.timezones || [],
        }));
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
</style>
