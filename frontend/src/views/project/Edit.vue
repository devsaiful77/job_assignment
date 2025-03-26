<template lang="">
  <div>
     <!-- breadcrumb -->
     <div class="breadcrumb">
      <h5>Project Edit</h5>
      <router-link class="btn btn-sm btn-success" :to="{ name: 'projects' }"
        >Project</router-link
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

      project_id: '',

      validationErrors: {},
    };
  },

  methods: {

    async findProject() {
      await axiosClient
        .get("/project/edit/" + this.$route.params.id)
        .then((resp) => {
          if (resp.data.status == true) {
            let project = resp.data.project;
            this.project_id = project.id;
            this.form.name = project.name;
            this.form.description = project.description;
            this.isLoading = false;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },


    async handleStore() {
      try {
        let response = await axiosClient.post("/project/update/" + this.project_id, this.form);
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

  created(){
    this.findProject();
  }

};
</script>
