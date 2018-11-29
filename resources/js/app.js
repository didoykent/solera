import Vue from 'vue'

import Vuetify from 'vuetify'


import 'vuetify/dist/vuetify.min.css'

import colors from 'vuetify/es5/util/colors'
import App from './App.vue'

import axios from 'axios'
import router from './router'


import store from './store'

Vue.use(Vuetify, {
  theme: {
    primary: '#263238', // #E53935
    secondary: colors.red.lighten4, // #FFCDD2
    accent: colors.indigo.base, // #3F51B5
    forbutton: '#1DE9B6',
    bluebutton: '#1E88E5'
  }
})


axios.interceptors.request.use(function(config){

  let token =  localStorage.getItem('token')

if(localStorage.getItem('token')){

  config.headers.Authorization = 'Bearer '+ localStorage.getItem('token');


}


  return config;
}, function(error){


    return Promise.reject(error);


});

axios.interceptors.response.use(function (response) {
    // Do something with response data

    return response

  }, function (error) {

    if(error.response.status === 400 || error.response.status === 401 || error.response.status === 403){


    }
    // Do something with response error
    return Promise.reject(error);
  });


const app = new Vue({


  el: '#app',
  template: '<app></app>',
  components: {App},
  router,
  store

})
