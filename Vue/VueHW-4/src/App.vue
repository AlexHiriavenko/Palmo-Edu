<template>
  <div
    class="app-wrapper"
    :class="themeClass"
  >
    <h1>Vue HW-4</h1>
    <ThemeSwitcher @toggle-theme="toggleTheme" />
    <ClickTimeSaver />
    <FormSubscription />
    <MethodsSwitcher />
    <DynamicЕlementsList />
    <TableCreator />
    <NestedList />
    <PaginationList />
  </div>
</template>

<script>
  import ClickTimeSaver from './components/ClickTimeSaver.vue';
  import FormSubscription from './components/FormSubscription.vue';
  import MethodsSwitcher from './components/MethodsSwitcher.vue';
  import DynamicЕlementsList from './components/DynamicЕlementsList.vue';
  import ThemeSwitcher from './components/ThemeSwitcher.vue';
  import TableCreator from './components/TableCreator.vue';
  import NestedList from './components/NestedFilteredList.vue';
  import PaginationList from './components/PaginationList.vue';

  export default {
    name: 'App',

    components: {
      ClickTimeSaver,
      FormSubscription,
      MethodsSwitcher,
      DynamicЕlementsList,
      ThemeSwitcher,
      TableCreator,
      NestedList,
      PaginationList,
    },

    data() {
      return {
        darkTheme: false,
      };
    },

    computed: {
      themeClass() {
        return this.darkTheme ? 'dark-theme' : 'light-theme';
      },
    },

    methods: {
      toggleTheme() {
        this.darkTheme = !this.darkTheme;
      },
    },
  };
</script>

<style>
  body {
    padding: 0;
    margin: 0;
  }

  h1 {
    margin: 0;
    padding: 16px;
    text-align: center;
  }

  .app-wrapper.light-theme {
    background-color: lightgray;
    color: #2c3e50;
  }

  .app-wrapper.dark-theme {
    background-color: #2c3e50;
    color: white;
    text-shadow: 1px 1px 1px black;
}

  button {
    cursor: pointer;
    font-size: 14px;
    padding: 6px;
    border-radius: 6px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

    .light-theme button {
      background-color: #c2eca9;
      color: #2c3e50;
    }

    .dark-theme button {
      background-color: #555;
      color: #fff;
    }

    .component {
      margin-left: 16px;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      max-width: 400px;
      margin-block: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #c2eca9;
    }

    .light-theme .component {
      background-color: #c2eca9;
    }

    .dark-theme .component {
      background-color: #4346f4;
    }
</style>
