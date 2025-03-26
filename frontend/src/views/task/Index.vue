<template lang="">
  <div>
    <!-- breadcrumb -->
    <div class="breadcrumb">
      <h5>Task List</h5>
      <router-link class="btn btn-sm btn-success" :to="{ name: 'task_create' }" v-if="user.role_id == 1"
        >Create</router-link
      >

      <router-link class="btn btn-sm btn-success" :to="{ name: 'task_import' }" v-if="user.role_id == 3"
        >Task Import</router-link
      >

    </div>
    <!-- breadcrumb -->

    <div class="card">
      <div class="card-body">
        <!-- {{user}} -->
        <p v-if="isLoading" class="spinner_1">
          <i class="fa fa-spin fa-spinner"></i>
        </p>
        <div v-else>
          <!-- admin table -->
          <table class="table" v-if="user.role_id == 1">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Project</th>
                <th scope="col">Assign To</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in tasks" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ item?.project?.name }}</td>
                <td>{{ item?.assigned_user?.name }}</td>
                <td>{{ item.status }}</td>
                <td>
                  <router-link
                    class="btn btn-sm btn-primary"
                    :to="{ name: 'task_edit', params: { id: item.id } }"
                    ><i class="fa-solid fa-pen-to-square"></i
                  ></router-link>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- user table -->
          <table class="table" v-if="user.role_id == 3">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in tasks" :key="index">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ item.title ?? '...' }}</td>
                <td>{{ item.description ?? '...' }}</td>
                <td>{{ item.status }}</td>
                <td>
                  <router-link
                    class="btn btn-sm btn-primary"
                    :to="{ name: 'task_user', params: { id: item.id } }"
                    ><i class="fa-solid fa-pen-to-square"></i
                  ></router-link>
                </td>
              </tr>
            </tbody>
          </table>



        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axiosClient from "../../axios";
export default {
  data() {
    return {
      isLoading: true,
      tasks: [],
    };
  },

  methods: {
    async getProject() {
      await axiosClient
        .get("/tasks")
        .then((resp) => {
          if (resp.data.status == true) {
            this.tasks = resp.data.tasks;
            this.isLoading = false;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  computed: {
    user() {
      return this.$store.state.user.data;
    },
  },

  created() {
    this.getProject();
  },
};
</script>
