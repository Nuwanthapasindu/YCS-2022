import { createApp } from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import "bootstrap/dist/css/bootstrap.min.css"
import 'animate.css';
import "bootstrap"
import axios from 'axios'
import SideBar from '@/components/Dashboard/SideBar'
import NavBar from '@/components/Dashboard/NavBar.vue'
import FooterWidget from '@/components/Dashboard/FooterWidget'

axios.defaults.baseURL = process.env.APP_SERVER_URL;



const app = createApp(App);
app.use(store);
app.use(router);
app.mount('#app');
app.component('side-bar', SideBar);
app.component('NavBar', NavBar);
app.component('dashboard-footer', FooterWidget);
document.title = process.env.APP_TITLE;
