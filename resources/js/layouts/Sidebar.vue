<template>
    <!-- ====================================== Sidebar Part Start ====================================== -->
    <v-navigation-drawer v-model="drawer" color="#2a3042">
      <v-layout column align-center>
        <div class="sidebar-brand">
          <div class="sidebar-logo">
            <img style="max-width: 60px; max-height:60px;"  src="" />
          </div>
          <div class="sidebar-name">
            <span>Saiful Islam</span>
            <h6>Admin</h6>
          </div>
        </div>
      </v-layout>
  
      <!-- Sidebar part -->
      <v-list dense>
        <v-list-item>
          <router-link to="/dashboard" class="custom_router_link">
            <span class="sidebar-menu-icon">
              <i class="fa-solid fa-house"></i>
            </span>
            Dashboard
          </router-link>
        </v-list-item>
  
        
  
  
        <!-- end v-list -->
      </v-list>
    </v-navigation-drawer>
    <!-- ====================================== Sidebar Part End ====================================== -->
    <v-app-bar color="#fff">
      <v-row>
        <v-col xl="1" lg="1" md="1" sm="2" cols="3" class="__custom__mobile__padding__right__zero">
          <div class="header_toggle_icon">
            <i class="fa-solid fa-bars" @click="drawer = !drawer"></i>
          </div>
        </v-col>
  
        <!-- right side -->
        <v-col xl="11" lg="11" md="11" sm="10" cols="9" class="__custom__mobile__padding__left__zero">
          <div class="menu__item">
            <v-menu>
              
  
              <v-list>
                <v-list-item class="header_profile_menu_link" router to="#" active-class="border">
                  <v-list-item-title> Change Password </v-list-item-title>
                </v-list-item>
  
                <v-list-item class="header_profile_menu_link" active-class="border">
                  <v-list-item-title>Log out</v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
          </div>
        </v-col>
      </v-row>
    </v-app-bar>
  </template>
  
  <script setup>
  import { ref } from "vue";
  const drawer = ref(null);
  </script>
  
  <script>
  export default {
    
    
  };
  </script>
  
  <style scoped>
  .header_toggle_icon {
    margin-left: 10px;
  }
  
  .header_toggle_icon i {
    background: rgba(70, 77, 235, 0.1);
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    border-radius: 100%;
    cursor: pointer;
    transition: 0.3s;
  }
  
  div.menu__item {
    display: flex;
    justify-content: end;
    align-items: center;
    margin-right: 20px;
  }
  
  .v-menu__content {
    border-radius: 4px;
    box-shadow: 0 5px 5px -3px rgba(0, 0, 0, 0.2),
      0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12);
    contain: content;
    display: inline-block;
    max-width: 80%;
    overflow-x: hidden;
    overflow-y: auto;
    position: absolute;
  }
  </style>
  