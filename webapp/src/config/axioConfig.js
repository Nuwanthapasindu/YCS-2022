import axios from 'axios'
// axios.defaults.baseURL ='https://testserver.virtuelsolutions.com/api/';
axios.defaults.baseURL = 'http://localhost:8000/api/';
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['Content-Type'] = 'application/json';