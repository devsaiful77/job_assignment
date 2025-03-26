<template lang="">
  <div>
    <!-- breadcrumb -->
    <div class="breadcrumb">
      <h5>Task Edit</h5>
      <router-link class="btn btn-sm btn-success" :to="{ name: 'tasks' }"
        >Tasks</router-link
      >
    </div>
    <!-- breadcrumb -->

    <div class="card">
      <div class="card-body">
        <form @submit.prevent="handleStore">
          <div class="mb-3">
            <label class="form-label">Project</label>
            <select class="form-control" v-model="form.project_id">
              <option value="">Select</option>
              <option
                :value="item.id"
                v-for="(item, index) in projects"
                :key="index"
              >
                {{ item.name }}
              </option>
            </select>

            <div v-if="validationErrors.project_id" class="err-message">
              {{ validationErrors.project_id[0] }}
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Assign</label>
            <select class="form-control" v-model="form.assigned_to">
              <option value="">Assign</option>
              <option
                :value="item.id"
                v-for="(item, index) in users"
                :key="index"
              >
                {{ item.name }}
              </option>
            </select>

            <div v-if="validationErrors.assigned_to" class="err-message">
              {{ validationErrors.assigned_to[0] }}
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
        project_id: "",
        assigned_to: "",
      },

      task_id: '',
      users: [],
      projects: [],

      isLoading: true,

      validationErrors: {},
    };
  },

  methods: {
    async getProjectUser() {
      await axiosClient
        .get("/task/user-project")
        .then((resp) => {
          if (resp.data.status == true) {
            this.users = resp.data.users;
            this.projects = resp.data.projects;
            this.isLoading = false;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },


    async getTask() {
      await axiosClient
        .get("/task/edit/" + this.$route.params.id)
        .then((resp) => {
          if (resp.data.status == true) {
            
            let task = resp.data.task;
            this.task_id = task.id
            this.form.project_id = task.project_id
            this.form.assigned_to = task.assigned_to

            this.isLoading = false;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },


    async handleStore() {
      try {
        let response = await axiosClient.post("/task/update/" + this.task_id, this.form);
        this.validationErrors = {};
        if (response.data.status == true) {
          this.$toast.success(response.data.message);
          this.$router.push({ name: "tasks" });
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

  created() {
    this.getProjectUser();
    this.getTask();
  },
};
</script>
