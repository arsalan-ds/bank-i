import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import config from './config'
import http from './http'
import vuetify from './plugins/vuetify'
import VueJsonPretty from 'vue-json-pretty';
import './assets/snackbar.scss'
import 'vue-json-pretty/lib/styles.css';
import './assets/app.css'
import './config/plugins';
import Highcharts from 'highcharts';
import Maps from 'highcharts/modules/map';
import VueCryptojs from 'vue-cryptojs'
import CryptoJs from 'crypto-js';
import HighchartsVue from 'highcharts-vue';
import nodata from "highcharts/modules/no-data-to-display";
import VueClipboard from 'vue-clipboard2'
import axios from "axios"


nodata(Highcharts);

import moment, {
} from 'moment';
Maps(Highcharts);
Vue.use(VueCryptojs);
Vue.use(VueClipboard)
Vue.use(CryptoJs);
Vue.use(HighchartsVue);
Vue.filter('formatDateStandard', function (date) {
  date = new Date(date);
  return date.toLocaleString('en-us', {
    month: 'short',
    day: '2-digit',
    year: 'numeric'
  })
});

Vue.filter('convertUTCtoLocalTime', function (date) {
  date = new Date(date);
  return moment(date).local().format('hh:mm a');
});

Vue.filter('convertUTCtoLocalDate', function (date) {
  date = new Date(date.replace(/ /g, "T"));
  return moment.utc(date).local().format('MMM DD, YYYY');
});

axios.interceptors.response.use(
  function (response) {
    return response;
  },
  function (error) {
    if (error.response.status === 401) {
      localStorage.removeItem("token");
      localStorage.removeItem("vuex");
      localStorage.removeItem("user");
      router.go("/");
    }
    return Promise.reject(error);
  }
);


Vue.config.productionTip = false

new Vue({
  router,
  store,
  config,
  VueJsonPretty,
  http,
  vuetify,

  render: h => h(App)
}).$mount('#app')
