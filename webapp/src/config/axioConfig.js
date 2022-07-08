import axios from 'axios'
axios.defaults.baseURL = process.env.VUE_APP_API_URL;
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['Content-Type'] = 'application/json';