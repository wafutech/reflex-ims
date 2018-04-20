// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import vClickOutside from 'v-click-outside'
//import from jQuery 'jquery';
import BootstrapVue from 'bootstrap-vue/dist/bootstrap-vue.esm'
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import axios from 'axios';
import VueAxios from 'vue-axios';
require('../static/js/jquery-3.3.1.js');
require('../static/css/navbar.css');
//require('../static/js/nalocalvbar.js');


 Vue.router = router
Vue.config.productionTip = false
Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';

new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
