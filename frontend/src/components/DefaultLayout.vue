<template lang="">
  <div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container">

        <div>
        <a class="navbar-brand" href="#">{{ userData.name }}</a>
        <span class="btn btn-success btn-sm" v-if="userData.role_id == 3"> Assign Task  </span>
        <span class="btn btn-success btn-sm" v-if="userData.role_id != 3"> Completed Task  </span>

        </div>



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
import Pusher from "pusher-js";
export default {
  data() {
    return {
      user: null,
      tasks: [],
      userId: 1,
      roleId: 2,
    };
  },
  computed: {
    userData() {
      return this.$store.state.user.data;
    },
  },
  created() {
    this.$store.dispatch("getUser");
  },


  mounted() {
    Pusher.logToConsole = true;
    const pusher = new Pusher("d844cc49690e223eb2c2", {
      cluster: "ap2",
      encrypted: true,
      authEndpoint: "http://localhost:8000/broadcasting/auth", 
      auth: {
        headers: {
          Authorization: `Bearer ${sessionStorage.getItem("TOKEN")}`,
        },
      },
    });

    // Listen for task updates for assigned users
    const taskChannel = pusher.subscribe(`private-tasks.${this.userData.id}`);
    taskChannel.bind("App\\Events\\TaskUpdatedEvent", (data) => {
      this.tasks.push(data);
    });

    // If the user is an admin or manager, listen to admin tasks
    if ([1, 2].includes(this.userData.role_id)) {
      const adminChannel = pusher.subscribe(`private-tasks.admins.${this.userData.id}`);
      adminChannel.bind("App\\Events\\TaskUpdatedEvent", (data) => {
        this.tasks.push(data);
      });
    }
  },


  methods: {
    logout() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push({ name: "Login" });
      });
    },
  },
};
</script>
