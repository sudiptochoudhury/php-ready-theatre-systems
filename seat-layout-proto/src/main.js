import $ from 'jquery';
import bootstrap from 'bootstrap';
import '../node_modules/bootstrap/scss/bootstrap.scss';

import Vue from 'vue'
import App from './App/index.vue'

Vue.config.productionTip = false

new Vue({
  render: h => h(App)
}).$mount('.app')

window.$ = $;