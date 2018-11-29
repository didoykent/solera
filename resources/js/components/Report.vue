<template>

  <v-app style="margin-top: 10vh">
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Phone Report</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      <v-text-field
         hide-details
          v-model="search"
 label="Search"
  append-icon="search"
    single-line
  ></v-text-field>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">

        <v-btn slot="activator" color="primary" dark class="mb-2">New Item</v-btn>
        <v-form ref="form" v-model="valid" lazy-validation>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>

                <v-flex xs12 sm6 md4>

                  <v-text-field v-model="editedItem.cubeNumber" label="Cube Number"  :rules="requiredRules" ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.phoneModel" label="Phone Model" :rules="requiredRules" ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.ktt" label="Ktt"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.nizz" label="Nizz"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.tmg" label="Tmg"></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-checkbox
      label="No Unit"
      v-model="editedItem.noUnit"
    ></v-checkbox>

                </v-flex>

                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.teacher" label="Teacher" :rules="requiredRules" ></v-text-field>
                </v-flex>


              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
            <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
          </v-card-actions>
        </v-card>
         </v-form>
      </v-dialog>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="desserts"
      class="elevation-1"
       :search="search"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.cubeNumber }}</td>
        <td class="text-xs-left">{{ props.item.phoneModel }}</td>
        <td class="text-xs-left">{{ props.item.ktt }}</td>
        <td class="text-xs-left">{{ props.item.nizz }}</td>
        <td class="text-xs-left">{{ props.item.tmg }}</td>

        <td class="text-xs-left" style="text-transform: uppercase;">{{ props.item.noUnit }}</td>




        <td class="text-xs-left" style="text-transform: uppercase;">{{ props.item.teacher }}</td>

        <td class="justify-center layout px-0">
          <v-icon
            small
            class="mr-2"
            @click="editItem(props.item)"
          >
            edit
          </v-icon>
          <v-icon
            small
            @click="deleteItem(props.item)"
          >
            delete
          </v-icon>
        </td>
      </template>


      <template slot="no-data">

      </template>

      <template slot="footer">
      <td><strong>Total</strong></td>
    <td></td>
        <td class="text-xs-left"><strong>{{kttCount}}</strong></td>
          <td class="text-xs-left"><strong>{{nizzCount}}</strong></td>
            <td class="text-xs-left"><strong>{{tmgCount}}</strong></td>
              <td class="text-xs-left"><strong>{{noUnitCount}}</strong></td>
            <td></td>
              <td></td>



  </template>


    </v-data-table>
  </div>

</v-app>
</template>

<script>

import axios from 'axios'

import Vue from 'vue'
  export default {
    data: () => ({
        valid: true,
         search: '',
      dialog: false,
      headers: [
        {
          text: 'Cube Number',
          align: 'left',
          sortable: false,
          value: 'cubeNumber'
        },
        { text: 'Phone Model', value: 'phoneModel', align: 'left' },
        { text: 'KTT', value: 'ktt', align: 'left' },
        { text: 'NIZ', value: 'nizz', align: 'left' },
        { text: 'TMG', value: 'tmg', align: 'left' },
        { text: 'NO UNIT', value: 'noUnit', align: 'left' },
        { text: 'TEACHER', value: 'teacher', align: 'left' },

        { text: 'Actions', value: 'name', sortable: false , align: 'center'}
      ],
      checkbox: false,
      desserts: [],
      kttCount: '',
      nizzCount: '',
      tmgCount: '',
      noUnitCount: '',
      editedIndex: -1,
      editedItem: {
        id: '',
        cubeNumber: '',
        phoneModel: '',
        ktt: '',
        nizz: '',
        tmg: '',
        noUnit: '',
        teacher: ''
      },
      defaultItem: {
        id: '',
        cubeNumber: '',
        phoneModel: '',
        ktt: '',
        nizz: '',
        tmg: '',
        noUnit: '',
        teacher: ''
      },

      requiredRules: [
       v => !!v || 'required',

     ],
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      }
    },

    watch: {
      dialog (val) {
        val || this.close()
      },






    },

    created () {
      this.initialize()

    },

    methods: {
      initialize () {

var vm = this
        axios.get('api/getReport').then(function(response){

          Vue.set(vm.$data, 'desserts', response.data.report)

          Vue.set(vm.$data, 'kttCount', response.data.kttCount)

          Vue.set(vm.$data, 'nizzCount', response.data.nizzCount)

          Vue.set(vm.$data, 'tmgCount', response.data.tmgCount)

          Vue.set(vm.$data, 'noUnitCount', response.data.noUnitCount)


        }).catch(function(error){


        })

      },

      editItem (item) {

        this.editedIndex = this.desserts.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
         var vm = this

        const formData = new FormData()

        formData.append('id', item.id)
        const index = this.desserts.indexOf(item)
        confirm('Are you sure you want to delete this item?')   && this.desserts.splice(index, 1) &&

        axios.post('api/deleteItem', formData).then(function(response){



          Vue.set(vm.$data, 'kttCount', response.data.kttCount)

          Vue.set(vm.$data, 'nizzCount', response.data.nizzCount)

          Vue.set(vm.$data, 'tmgCount', response.data.tmgCount)

          Vue.set(vm.$data, 'noUnitCount', response.data.noUnitCount)




        }).catch(function(error){

          console.log(error)
        })



      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {

        var vm = this
        if (vm.editedIndex > -1) {
              if (vm.$refs.form.validate()) {


            const formData = new FormData();
            formData.append('id', vm.editedItem.id)
            formData.append('cubeNumber', vm.editedItem.cubeNumber)
            formData.append('phoneModel', vm.editedItem.phoneModel)
            formData.append('ktt', vm.editedItem.ktt)
            formData.append('nizz', vm.editedItem.nizz)
            formData.append('tmg', vm.editedItem.tmg)
            formData.append('noUnit', vm.editedItem.noUnit)
            formData.append('teacher', vm.editedItem.teacher)




            axios.post('api/editItem', formData).then(function(response){



                  Vue.set(vm.$data, 'kttCount', response.data.kttCount)

                  Vue.set(vm.$data, 'nizzCount', response.data.nizzCount)

                  Vue.set(vm.$data, 'tmgCount', response.data.tmgCount)

                  Vue.set(vm.$data, 'noUnitCount', response.data.noUnitCount)


                    Vue.set(vm.$data, 'desserts', response.data.report)

            }).catch(function(error){


            })
this.close()
          }

        } else {

            if (this.$refs.form.validate()) {






          const formData = new FormData();
          formData.append('id', this.editedItem.id)
          formData.append('cubeNumber', this.editedItem.cubeNumber)
          formData.append('phoneModel', this.editedItem.phoneModel)
          formData.append('ktt', this.editedItem.ktt)
          formData.append('nizz', this.editedItem.nizz)
          formData.append('tmg', this.editedItem.tmg)
          formData.append('noUnit', this.editedItem.noUnit)
          formData.append('teacher', this.editedItem.teacher)

          axios.post('api/createItem', formData).then(function(response){

              vm.desserts.push(response.data.newItem)



                Vue.set(vm.$data, 'kttCount', response.data.kttCount)

                Vue.set(vm.$data, 'nizzCount', response.data.nizzCount)

                Vue.set(vm.$data, 'tmgCount', response.data.tmgCount)

                Vue.set(vm.$data, 'noUnitCount', response.data.noUnitCount)




          }).catch(function(error){
            console.log(error)

          })
  this.close()
        }

      }

      },


      testData(){

        axios.get('api/getReport').then(function(response){


        }).catch(function(error){


        })
      }
    }
  }
</script>

<style lang="css">
</style>
