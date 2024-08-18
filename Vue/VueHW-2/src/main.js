import { createApp } from "vue";
import App from "./App.vue";
import GlobalComponent from "./components/GlobalComponent.vue";

const app = createApp(App);

// Створіть нові компоненти та зареєструйте іх локально і глобально (хоча б один компонент).
app.component("GlobalComponent", GlobalComponent);

app.mount("#app");

import axios from "./axios.js";

const req = await axios.get("blockchain/list");

console.log(req);
