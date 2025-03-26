<template>
    <v-app id="inspire">
        <SidebarVue></SidebarVue>
        <v-main class="home-page">
            <router-view></router-view>
        </v-main>
    </v-app>
</template>


<script>
import SidebarVue from './Sidebar.vue';
import FooterVue from './Footer.vue';

export default {
    components: {
        SidebarVue,
    },

    
    
}
</script>