<template>
  <layout-div>
    <h2 class="text-left mt-5 mb-3">Update Pasien</h2>
    <div class="card">
      <div class="card-header">
        <router-link class="btn btn-outline-info float-right" to="/"
          >List
        </router-link>
      </div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label htmlFor="name">Name</label>
            <input
              v-model="Tes.name"
              type="text"
              class="form-control"
              id="name"
              name="name"
            />
          </div>
          <div class="form-group">
            <label htmlFor="sex">Sex</label>
            <input
              v-model="Tes.sex"
              type="text"
              class="form-control"
              id="sex"
              name="sex"
            />
          </div>
          <div class="form-group">
            <label htmlFor="religion">Religion</label>
            <input
              v-model="Tes.religion"
              type="text"
              class="form-control"
              id="religion"
              name="religion"
            />
          </div>
          <div class="form-group">
            <label htmlFor="phone">Phone</label>
            <input
              v-model="Tes.phone"
              type="text"
              class="form-control"
              id="phone"
              name="phone"
            />
          </div>
          <div class="form-group">
            <label htmlFor="address">Address</label>
            <textarea
              v-model="Tes.address"
              class="form-control"
              id="address"
              rows="3"
              name="address"
            ></textarea>
          </div>
          <div class="form-group">
            <label htmlFor="nik">Nik</label>
            <input
              v-model="Tes.nik"
              type="text"
              class="form-control"
              id="nik"
              name="nik"
            />
          </div>
          <button
            @click="handleSave()"
            :disabled="isSaving"
            type="button"
            class="btn btn-outline-primary mt-3"
          >
            Update
          </button>
        </form>
      </div>
    </div>
  </layout-div>
</template>

<script>
import axios from "axios";
import LayoutDiv from "../LayoutDiv.vue";
import Swal from "sweetalert2";

export default {
  name: "Update",
  components: {
    LayoutDiv,
  },
  data() {
    return {
      Tes: {
        name: "",
        sex: "",
        religion: "",
        phone: "",
        address: "",
        nik: "",
      },
      isSaving: false,
    };
  },
  created() {
    const id = this.$route.params.id;
    axios
      .get(`get?id=${id}`)
      .then((response) => {
        let TesInfo = response.data.result;
        this.Tes.id = TesInfo.id;
        this.Tes.name = TesInfo.name;
        this.Tes.sex = TesInfo.sex;
        this.Tes.religion = TesInfo.religion;
        this.Tes.phone = TesInfo.phone;
        this.Tes.address = TesInfo.address;
        this.Tes.nik = TesInfo.nik;
        return response;
      })
      .catch((error) => {
        Swal.fire({
          icon: "error",
          title: "An Error Occured!",
          showConfirmButton: false,
          timer: 1500,
        });
        return error;
      });
  },
  methods: {
    handleSave() {
      this.isSaving = true;
      const urlencoded = new URLSearchParams();
      urlencoded.append("id", this.Tes.id);
      urlencoded.append("name", this.Tes.name);
      urlencoded.append("sex", this.Tes.sex);
      urlencoded.append("religion", this.Tes.religion);
      urlencoded.append("phone", this.Tes.phone);
      urlencoded.append("address", this.Tes.address);
      urlencoded.append("nik", this.Tes.nik);

      const requestOptions = {
        method: "POST",
        body: urlencoded,
        redirect: "follow",
      };

      fetch("http://localhost:8000/api/update", requestOptions)
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Tes updated successfully!",
            showConfirmButton: false,
            timer: 1500,
          });
          this.isSaving = false;
          this.Tes.name = this.Tes.name;
          this.Tes.sex = this.Tes.sex;
          this.Tes.religion = this.Tes.religion;
          this.Tes.phone = this.Tes.phone;
          this.Tes.address = this.Tes.address;
          this.Tes.nik = this.Tes.nik;
          return response;
        })
        .catch((error) => {
          this.isSaving = false;
          Swal.fire({
            icon: "error",
            title: "An Error Occured!",
            showConfirmButton: false,
            timer: 1500,
          });
          return error;
        })
        .then((result) => console.log(result))
        .catch((error) => console.error(error));
    },
  },
};
</script>
