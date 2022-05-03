require('./bootstrap');
require('./chart');
require('./orderLastMonth');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';