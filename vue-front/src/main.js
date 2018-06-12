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
import VeeValidate from 'vee-validate';
require('../static/js/jquery-3.3.1.js');
require('../static/css/navbar.css');
//require('../static/js/nalocalvbar.js');


 Vue.router = router
Vue.config.productionTip = false
Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);
Vue.use(VeeValidate);

//axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';
Vue.axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';
/*Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js')
})*/
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
