<template lang="">
  <div>
     <!-- breadcrumb -->
     <div class="breadcrumb">
      <h5>Project Create</h5>
      <router-link class="btn btn-sm btn-success" :to="{ name: 'projects' }"
        >Projects</router-link
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
            <label class="form-label">Description</label>
            <textarea class="form-control" v-model="form.description"></textarea>
            <div v-if="validationErrors.description" class="err-message">
              {{ validationErrors.description[0] }}
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
        description: "",
      },

      validationErrors: {},
    };
  },

  methods: {
    async handleStore() {
      try {
        let response = await axiosClient.post("/project/store", this.form);
        this.validationErrors = {}; 
        if(response.data.status == true){
          this.$toast.success(response.data.message);
          this.$router.push({ name: 'projects' });
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
