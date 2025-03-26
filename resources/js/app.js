import "./bootstrap";
import { createApp } from "vue";

// import file
import App from "./App.vue";
import router from "./routes";
import store from "./store";

// vuetify
import "vuetify/styles";
import "@mdi/font/css/materialdesignicons.css";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";


const vuetify = createVuetify({
    components,
    directives,
});

// import laravel vue paginate
import { Bootstrap5Pagination as LaravelVuePagination } from "laravel-vue-pagination";
// import sweetalert plugin
import VueSweetAlert from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

// vue progress bar
import VueProgressBar from "@aacassandra/vue3-progressbar";
const options = {
    color: "#bffaf3",
    failedColor: "#874b4b",
    thickness: "5px",
    transition: {
        speed: "0.2s",
        opacity: "0.6s",
        termination: 300,
    },
    autoRevert: true,
    location: "left",
    inverse: false,
};

// import toaster plugin
import Vue3Toastify, { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const Vue3ToastifyOptions = {
    // position: 'top-right',
    position: "top-center",
    duration: 1000,
};

const app = createApp(App);
app.use(vuetify);
app.use(router);
app.use(store);
app.use(VueSweetAlert)

// register globally
app.component("pagination", LaravelVuePagination);
app.use(Vue3Toastify, Vue3ToastifyOptions);
app.use(VueProgressBar, options);
// Set up toast globally
app.config.globalProperties.$toast = toast;
app.mount("#adminApp");
