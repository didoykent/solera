<template>
    <div>
<v-app>



  <v-navigation-drawer
       v-model="drawer"
       temporary
       absolute
       style="background-color: #041e30 !important;
       border-color: #041e30 !important;" dark>
     >

       <v-list class="pt-0" dense>

         <v-list-tile-content>

                 <router-link :to="{ name: '', params: {} }">ABOUT</router-link>
                 <router-link :to="{ name: '', params: {} }">SPONSORS</router-link>
                 <router-link :to="{ name: '', params: {} }">TEAM</router-link>
                 <router-link :to="{ name: '', params: {} }">GALLERY</router-link>
                 <router-link :to="{ name: '', params: {} }">LIBRARY</router-link>
                 <router-link :to="{ name: '', params: {} }">SHOP</router-link>

                  </v-list-tile-content>
         </v-list-tile>
       </v-list>
     </v-navigation-drawer>

  <v-toolbar  fixed style="background-color: #041e30 !important;
  border-color: #041e30 !important;" dark>

      <v-toolbar-side-icon  @click.native.stop="drawer = !drawer" class="hidden-md-and-up"></v-toolbar-side-icon>

      <v-toolbar-title  style = "margin:0px; " ><img src="images/cafe2.png"  style="max-width: 40px; margin-right:10px; display:flex; "/></v-toolbar-title><h2 style="font-size: 20px;">Data Report</h2>

      <v-spacer></v-spacer>






      <v-toolbar-items class="hidden-sm-and-down" v-if = "!isLogged" >


        <v-btn flat  to="student-login">LOGIN </v-btn>



          <v-btn flat class = "depressed  forbutton" >ENGLISH</v-btn>
      </v-toolbar-items>






      <v-toolbar-items class="hidden-sm-and-down" v-if = "isLogged" >


        <v-btn flat class = "" color = "#fff" @click.native = "studentLogOut" >LOGOUT</v-btn>



          <v-btn flat class = "depressed  forbutton">ENGLISH</v-btn>
      </v-toolbar-items>

    </v-toolbar>

  <router-view></router-view>

  </v-app>


</div>
</template>

<script>

import {mapState , mapGetters} from 'vuex'
export default {

  data(){

    return{

      drawer: false

    }
  },

  computed:{

...mapGetters([

  'isLogged'
])
},

methods:{


  studentLogOut(){

    var vm  = this



    vm.$store.dispatch('studentLogOut')




  }
}
}
</script>

<style lang="css">

</style>
