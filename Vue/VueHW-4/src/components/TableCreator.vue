<template>
  <div class="component">
    <h2>TableCreator</h2>
    <label>
      Rows:
      <input
        type="number"
        v-model="rows"
        min="1"
        max="10"
      />
    </label>
    <label>
      Columns:
      <input
        type="number"
        v-model="columns"
        min="2"
        max="10"
      />
    </label>
    <table>
      <tr
        v-for="row in rows"
        :key="row"
      >
        <td
          v-for="col in columns"
          :key="col"
        >
          Row {{ row }} Col {{ col }}
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
  export default {
    name: 'ThemeSwitcher',
    data() {
      return {
        rows: 3,
        columns: 3,
      };
    },
  };
</script>

<style>
  .component {
    min-width: 80vw;
  }

  table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  border: 2px solid black;
  padding: 8px;
  text-align: center;
}

th {
  background-color: #c8c8c8;
  color: #333;
  font-weight: bold;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

tr:nth-child(odd) {
  background-color: #8becf5;
}
</style>
