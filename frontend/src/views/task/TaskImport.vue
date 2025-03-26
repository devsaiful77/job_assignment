<template lang="">
  <div>
    <!-- breadcrumb -->
    <div class="breadcrumb">
      <h5>Task Create</h5>
      <router-link class="btn btn-sm btn-success" :to="{ name: 'tasks' }"
        >Tasks</router-link
      >
    </div>
    <!-- breadcrumb -->

    <div class="card">
      <div class="card-body">
        <form @submit.prevent="uploadCsv">
          <div class="mb-3">
            <label class="form-label">Project</label>
            <input type="file" accept=".csv" @change="handleFileUpload" class="form-control" />
            <p>{{ uploadStatus }}</p>

            <div v-if="validationErrors.project_id" class="err-message">
              {{ validationErrors.project_id[0] }}
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import axiosClient from "../../axios";

const file = ref(null);
const uploadStatus = ref("");
const validationErrors = ref({});

const handleFileUpload = (event) => {
  file.value = event.target.files[0];
};

const uploadCsv = async () => {
  if (!file.value) {
    uploadStatus.value = "Please select a CSV file!";
    return;
  }

  const formData = new FormData();
  formData.append("csv_file", file.value);

  try {
    uploadStatus.value = "Uploading...";
    const response = await axiosClient.post(
      "/upload-tasks",
      formData,
      {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      }
    );

    this.validationErrors.value = {}

    uploadStatus.value = response.data.message;
  } catch (error) {
    uploadStatus.value = "Upload failed!";
    console.error(error);

    if (err.response && err.response.data && err.response.data.errors) {
          validationErrors.value = { ...err.response.data.errors }; // Ensure reactivity
          this.$toast.error("There were validation errors!");
        } else {
          this.$toast.error("An error occurred. Please try again.");
        }



  }
};
</script>
