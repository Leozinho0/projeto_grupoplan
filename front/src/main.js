import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import vuetify from './plugins/vuetify'
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
import Vue2Filters from 'vue2-filters'
import Notifications from 'vue-notification'
import './assets/css/main.css'

Vue.config.productionTip = false

Vue.use(VueSweetalert2);
Vue.use(Vue2Filters);
Vue.use(Notifications);

const moment = require('moment');
require('moment/locale/pt-br');

Vue.use(require('vue-moment'), {
  moment
});

new Vue({
  router,
  store,
  axios,
  vuetify,
  Notifications,
  render: h => h(App)
}).$mount('#app')
