import { createApp } from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import "bootstrap/dist/css/bootstrap.min.css"
import 'animate.css';
import "bootstrap"
import '@/config/axioConfig'
import SideBar from '@/components/Dashboard/common/SideBar'
import NavBar from '@/components/Dashboard/common/NavBar.vue'
import FooterWidget from '@/components/Dashboard/common/FooterWidget'
import '@/store/auth/subscriber'


const app = createApp(App);
app.use(store);
app.use(router);
app.mount('#app');
app.component('side-bar', SideBar);
app.component('NavBar', NavBar);
app.component('dashboard-footer', FooterWidget);

if (localStorage.getItem('token')) {

    store.dispatch('auth/attempt', localStorage.getItem('token'));
}
