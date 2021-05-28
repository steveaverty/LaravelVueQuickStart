import { createApp } from "vue";

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import "@fortawesome/fontawesome-free/css/all.min.css";
import "@/assets/styles/tailwind.css";

import App from "@/App.vue";

import router from './router'
import store from './store'

const toastOptions = {
    // You can set your default options here
};

const app = createApp(App);
app.config.devtools = true

app.use(router);
app.use(store);
app.use(Toast, toastOptions);

app.mount("#app");


// const app = createApp(App).use(router).mount("#app");
// app.provide('store', store);
