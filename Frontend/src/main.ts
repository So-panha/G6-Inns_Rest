import 'bootstrap/dist/css/bootstrap.min.css'; // Import Bootstrap CSS
import './assets/main.css';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import axios from './plugins/axios';
import 'uno.css';
import { configure } from 'vee-validate';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp(App);

configure({
  validateOnInput: true,
});

app.use(createPinia());
app.use(router.router);
app.use(ElementPlus);
app.use(VueSweetalert2);

app.config.globalProperties.$axios = axios;

app.mount('#app');
