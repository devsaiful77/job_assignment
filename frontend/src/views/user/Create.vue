<template lang="">
  <div>
     <!-- breadcrumb -->
     <div class="breadcrumb">
      <h5>User Create</h5>
      <router-link class="btn btn-sm btn-success" :to="{ name: 'users' }"
        >Users</router-link
      >
    </div>
    <!-- breadcrumb -->

    <div class="card">
      <div class="card-body">
        <form @submit.prevent="handleStore">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" v-model="form.name" />
            <div v-if="validationErrors.name" class="err-message">
              {{ validationErrors.name[0] }}
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" v-model="form.email" />
            <div v-if="validationErrors.email" class="err-message">
              {{ validationErrors.email[0] }}
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" class="form-control" v-model="form.password" />
            <div v-if="validationErrors.password" class="err-message">
              {{ validationErrors.password[0] }}
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input
              type="text"
              class="form-control"
              v-model="form.password_confirmation"
            />
            <div v-if="validationErrors.password_confirmation" class="err-message">
              {{ validationErrors.password_confirmation[0] }}
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Role</label>

            <select class="form-control" v-model="form.role_id">
              <option value="">Select</option>
              <option
                :value="item.id"
                v-for="(item, index) in roles"
                :key="index"
              >
                {{ item.name }}
              </option>
            </select>
            <div v-if="validationErrors.role_id" class="err-message">
              {{ validationErrors.role_id[0] }}
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import axiosClient from "../../axios";
export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        role_id: "",
      },

      roles: [
        { id: 1, name: "admin" },
        { id: 2, name: "manager" },
        { id: 3, name: "user" },
      ],

      validationErrors: {},
    };
  },

  methods: {
    async handleStore() {
      try {
        let response = await axiosClient.post("/user/store", this.form);
        this.validationErrors = {}; 
        if(response.data.status == true){
          this.$toast.success(response.data.message);
          this.$router.push({ name: 'users' });
        }


      } catch (err) {
        
        if (err.response && err.response.data && err.response.data.errors) {
          this.validationErrors = { ...err.response.data.errors }; // Ensure reactivity
          this.$toast.error("There were validation errors!");
        } else {
          this.$toast.error("An error occurred. Please try again.");
        }
      }
    },
  },
};
</script>
<style lang=""></style>
