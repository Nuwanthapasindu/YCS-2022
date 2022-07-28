import axios from 'axios'
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';
// axios.defaults.baseURL ='https://testserver.virtuelsolutions.com/api/';
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['Content-Type'] = 'application/json';