import { createApp } from 'vue'
import store from './store'
import router from './router'
import App from './App.vue'


// import sweetalert plugin
import VueSweetAlert from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

// import toaster plugin
import Vue3Toastify, { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css';

const Vue3ToastifyOptions  = {
  // position: 'top-right',
  position: 'top-center',
  duration: 1000,
};

const app = createApp(App);

app.use(store)
app.use(router)
app.use(VueSweetAlert);

app.use(Vue3Toastify,Vue3ToastifyOptions);
app.config.globalProperties.$toast = toast

app.mount('#app')