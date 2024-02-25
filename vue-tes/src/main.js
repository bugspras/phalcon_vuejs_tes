import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import { createRouter, createWebHistory } from 'vue-router';
import List from './components/pages/List.vue';
import Add from './components/pages/Add.vue';
import Update from './components/pages/Update.vue';
import Detail from './components/pages/Detail.vue';
  
axios.defaults.baseURL = "http://localhost:8000/api/"
  
const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: List },
    { path: '/add', component: Add },
    { path: '/update/:id', component: Update },
    { path: '/detail/:id', component: Detail },
  ],
});
  
createApp(App).use(router).mount('#app');