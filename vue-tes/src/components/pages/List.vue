<template>
    <layout-div>
          <div class="container">
              <h2 class="text-left mt-5 mb-">List Pasien</h2>
              <div class="card">
                  <div class="card-header">
                      <router-link to="/add"
                          class="btn btn-outline-primary"
                          >Add
                      </router-link>
                  </div>
                  <div class="card-body">
               
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Sex</th>
                                  <th>Religion</th>
                                  <th>Phone</th>
                                  <th>Address</th>
                                  <th>Nik</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                               
                              <tr v-for="Tes in Tess" :key="Tes.id">
                                  <td>{{Tes.name}}</td>
                                  <td>{{Tes.sex}}</td>
                                  <td>{{Tes.religion}}</td>
                                  <td>{{Tes.phone}}</td>
                                  <td>{{Tes.address}}</td>
                                  <td>{{Tes.nik}}</td>
                                  <td>
                                      <router-link :to="`/detail/${Tes.id}`" class="btn btn-outline-info mx-1">Detail</router-link>
                                      <router-link :to="`/update/${Tes.id}`" class="btn btn-outline-success mx-1">Update</router-link>
                                      <button 
                                          @click="handleDelete(Tes.id)"
                                          className="btn btn-outline-danger mx-1">
                                          Delete
                                      </button>
                                  </td>
                              </tr>
                                   
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </layout-div>
  </template>
   
  <script>
  import axios from 'axios';
  import LayoutDiv from '../LayoutDiv.vue';
  import Swal from 'sweetalert2'
   
  export default {
    name: 'List',
    components: {
      LayoutDiv,
    },
    data() {
      return {
        Tess:[]
      };
    },
    created() {
      this.fetchTesList();
    },
    methods: {
      fetchTesList() {
        axios.get(`get`)
          .then(response => {
              this.Tess = response.data.result;
              return response
          })
          .catch(error => {
            return error
          });
      },
      handleDelete(id){
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                  axios.delete(`delete?id=${id}`)
                  .then( response => {
                      Swal.fire({
                          icon: 'success',
                          title: 'Tes deleted successfully!',
                          showConfirmButton: false,
                          timer: 1500
                      })
                      this.fetchTesList();
                      return response
                  })
                  .catch(error => {
                      Swal.fire({
                           icon: 'error',
                          title: 'An Error Occured!',
                          showConfirmButton: false,
                          timer: 1500
                      })
                      return error
                  });
              }
            })
      }
    },
  };
  </script>