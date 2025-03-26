<template lang="">
  <div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container">
        <a class="navbar-brand" href="#">{{ user.name }}</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link class="nav-link" aria-current="page" :to="{ name: 'users' }">Users</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'projects' }">Project</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'tasks' }">Tasks</router-link>
            </li>
            <li class="nav-item">
              <button
                style="margin-top: 5px"
                type="button"
                class="btn btn-sm btn-success"
                @click="logout"
              >
                Logout
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- pages -->
    <div class="container">
      <div class="row">
        <div class="col-md-12" style="padding: 20px 0px">
          <router-view :key="$route.path"></router-view>
        </div>
      </div>
    </div>
    <!-- pages -->
  </div>
</template>

<script>
import { useStore } from "vuex";
import { computed } from "vue";
import { useRouter } from "vue-router";

export default {
  setup() {
    const store = useStore();
    const router = useRouter();

    function logout() {
      store.dispatch("logout").then(() => {
        router.push({
          name: "Login",
        });
      });
    }

    store.dispatch("getUser");

    return {
      user: computed(() => store.state.user.data),
      logout,
    };
  },
};
</script>
