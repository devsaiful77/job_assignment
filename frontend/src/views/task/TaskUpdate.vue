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
            <label class="form-label">Title</label>
            <input class="form-control" v-model="form.title" />
            <div v-if="validationErrors.title" class="err-message">
              {{ validationErrors.title[0] }}
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" v-model="form.description"></textarea>
            <div v-if="validationErrors.description" class="err-message">
              {{ validationErrors.description[0] }}
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Is Completed</label>
            <select class="form-control" v-model="form.status">
              <option value="">Select</option>
              <option value="completed">Yes</option>
              <option value="pending">No</option>
            </select>

            <div v-if="validationErrors.status" class="err-message">
              {{ validationErrors.status[0] }}
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
        title: "",
        description: "",
        status: "",
      },

      task_id: "",
      isLoading: true,

      validationErrors: {},
    };
  },

  methods: {
    async getTask() {
      await axiosClient
        .get("/task/edit/" + this.$route.params.id)
        .then((resp) => {
          if (resp.data.status == true) {
            let task = resp.data.task;
            this.task_id = task.id;
            this.form.title = task.title;
            this.form.description = task.description;
            this.form.status = task.status;

            this.isLoading = false;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },

    async handleStore() {
      try {
        let response = await axiosClient.post(
          "/task/user/update/" + this.task_id,
          this.form
        );
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
    this.getTask();
  },
};
</script>
