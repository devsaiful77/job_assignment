<template lang="">
  <div>
    <!-- breadcrumb -->
    <div class="breadcrumb">
      <h5>Project List</h5>
      <router-link class="btn btn-sm btn-success" :to="{ name: 'project_create' }"
        >Create</router-link
      >
    </div>
    <!-- breadcrumb -->

    <div class="card">
      <div class="card-body">
        <p v-if="isLoading" class="spinner_1">
            <i class="fa fa-spin fa-spinner"></i>
        </p>
        <table class="table" v-else>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Create By</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in projects" :key="index">
              <th scope="row">{{ index+1 }}</th>
              <td>{{item.name}}</td>
              <td>{{item.description}}</td>
              <td>{{ item?.create_by?.name }}</td>
              <td>
                <router-link class="btn btn-sm btn-primary" :to="{name: 'project_edit', params: {id: item.id}}"><i class="fa-solid fa-pen-to-square"></i></router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axiosClient from "../../axios";
export default {
    data(){
        return {
            isLoading: true,
            projects : [],
        }
    },

    methods: {
        async getProject(){
            await axiosClient
            .get('/projects')
            .then((resp) => {
                if(resp.data.status == true){
                    this.projects = resp.data.projects
                    this.isLoading = false
                }
            })
            .catch((err) => {
                console.log(err)
            })
        }
    },

    created(){
        this.getProject()
    }



};
</script>
