<template>
    <layout-div>
         <h2 class="text-left mt-5 mb-3">Detail Pasien</h2>
         <div class="card">
             <div class="card-header">
                 <router-link 
                     class="btn btn-outline-info float-right"
                     to="/">List
                 </router-link>
             </div>
             <div class="card-body">
                 <b className="text-muted">Name:</b>
                 <p>{{Tes.name}}</p>
                 <b className="text-muted">Sex:</b>
                 <p>{{Tes.sex}}</p>
                 <b className="text-muted">Religon:</b>
                 <p>{{Tes.religion}}</p>
                 <b className="text-muted">Phone:</b>
                 <p>{{Tes.phone}}</p>
                 <b className="text-muted">Address:</b>
                 <p>{{Tes.address}}</p>
                 <b className="text-muted">Nik:</b>
                 <p>{{Tes.nik}}</p>
             </div>
         </div>
    </layout-div>
 </template>
  
 <script>
 import axios from 'axios';
 import LayoutDiv from '../LayoutDiv.vue';
 import Swal from 'sweetalert2'
  
 export default {
   name: 'Detail',
   components: {
     LayoutDiv,
   },
   data() {
     return {
       Tes: {
         name: '',
         sex: '',
         religion: '',
         phone: '',
         address: '',
         nik: '',
       },
       isSaving:false,
     };
   },
   created() {
     const id = this.$route.params.id;
     axios.get(`get?id=${id}`)
     .then(response => {
         let TesInfo = response.data.result
         this.Tes.name = TesInfo.name
         this.Tes.sex = TesInfo.sex
         this.Tes.religion = TesInfo.religion
         this.Tes.phone = TesInfo.phone
         this.Tes.address = TesInfo.address
         this.Tes.nik = TesInfo.nik
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
     })
   },
   methods: {
      
   },
 };
 </script>