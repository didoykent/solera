import Vue from 'vue'

import VueRouter from 'vue-router'

import axios from 'axios'

import store from './store'



Vue.use(VueRouter)


const notLogged = (to, from, next) => {
  if (!store.getters.isLogged) {
    next()
    return
  }
  next('/student-login')
}



const isLogged = (to, from, next) => {
  if (store.getters.isLogged) {
    next()
    return
  }
  next('/report')
}



const router = new VueRouter({



  routes: [

    {path: '/', component:require('./components/Auth/StudentLogin.vue'),  beforeEnter: notLogged},
    {path: '/student-login', component:require('./components/Auth/StudentLogin.vue'),  beforeEnter: notLogged},
    {path: '/student-logout',component:require('./components/Auth/StudentLogout.vue'), beforeEnter: isLogged},
    {path: '/report', component:require('./components/Report.vue'), beforeEnter: isLogged}


  ]
});


export default router
