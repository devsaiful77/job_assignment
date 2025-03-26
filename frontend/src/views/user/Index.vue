<template lang="">
  <div>
    <!-- breadcrumb -->
    <div class="breadcrumb">
      <h5>User List</h5>
      <router-link class="btn btn-sm btn-success" :to="{ name: 'user_create' }"
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
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in user_list" :key="index">
              <th scope="row">{{ index+1 }}</th>
              <td>{{item.name}}</td>
              <td>{{item.email}}</td>
              <td>{{ item?.role?.name }}</td>
              <td>
                <router-link class="btn btn-sm btn-primary" :to="{name: 'user_edit', params: {id: item.id}}"><i class="fa-solid fa-pen-to-square"></i></router-link>



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
            user_list : [],
        }
    },

    methods: {
        async getUser(){
            await axiosClient
            .get('/users')
            .then((resp) => {
                if(resp.data.status == true){
                    this.user_list = resp.data.users
                    this.isLoading = false
                }
            })
            .catch((err) => {
                console.log(err)
            })
        }
    },

    created(){
        this.getUser()
    }



};
</script>
