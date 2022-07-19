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
import { VCalendar, Calendar } from 'v-calendar';


const app = createApp(App);
// Use plugin with defaults
app.use(VCalendar, {})
app.use(store);
app.use(router);
app.mount('#app');
app.component('side-bar', SideBar);
app.component('NavBar', NavBar);
app.component('dashboard-footer', FooterWidget);
app.component('dashboard-Calendar', Calendar);


if (localStorage.getItem('token')) {

    store.dispatch('auth/attempt', localStorage.getItem('token'));
}
