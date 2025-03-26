<template>
    <div>
        <section>
            <div class="auth-area">
                <v-container>
                    <v-row style="
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                        ">
                        <v-col cols="12" lg="5" xl="5" md="6">
                            <v-card class="card auth-card">
                                <div class="auth-head">
                                    <v-row>
                                        <v-col cols="7" class="auth-phone-width-text">
                                            <div color="blue-darken-3" class="py-6 px-6">
                                                <h5 class="auth-main-title text-primary">
                                                    Welcome Back !
                                                </h5>
                                                <p class="auth-pra">
                                                    Login Your Account.
                                                </p>
                                            </div>
                                        </v-col>
                                        <v-col cols="5" class="align-self-end auth-phone-width-img">
                                            <img :src="static_image +
                                                'profile/1.png'
                                                " alt="" class="img-fluid" />
                                        </v-col>
                                    </v-row>
                                </div>
                                <div class="card-body py-6 px-6">
                                    <!-- <div class="auth-logo">
                                        <a href="/admin/login">
                                            <img :src="static_image +
                                                'logo/logo.png'
                                                " alt="" />
                                        </a>
                                    </div> -->
                                    <div class="p-2">
                                        <form @submit.prevent="login" >
                                            <div class="form-group-content mb-3">
                                                <label class="form-group-label">Email</label>
                                                <input class="form-group-input" type="email" v-model="form.email"
                                                    placeholder="Enter Email Address" />
                                                <div class="error" v-if="form.errors.has('email')"
                                                    v-html="form.errors.get('email')" ></div>
                                            </div>

                                            <div class="form-group-content">
                                                <label class="form-group-label">Password</label>
                                                <input class="form-group-input" type="password" v-model="form.password"
                                                    placeholder="********" />
                                                <div class="error" v-if="form.errors.has('password')"
                                                    v-html="form.errors.get('password')" />
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check" />
                                                <label class="form-check-label" for="remember-check">
                                                    Remember me
                                                </label>
                                            </div>

                                            <div class="mt-3 d-grid">
                                                <button class="login__button" type="submit">
                                                    <v-progress-circular v-if="loading" indeterminate color="primary" style="
                                                            width: 20px;
                                                            height: 20px;
                                                            margin-right: 10px;
                                                        "></v-progress-circular>Log In
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </v-card>


                        </v-col>
                    </v-row>
                </v-container>
            </div>
        </section>
    </div>
</template>

<script>
import Form from "vform";


export default {
    data() {
        return {
            static_image: '',
            form: new Form({
                email: "",
                password: "",
            }), 
            loading: false,
        };
    },

    methods: {

        
        login() {
            this.loading = true;
            this.form
                .post("/api/admin/login")
                .then((resp) => {
                    if (resp.data.status == true) {
                        this.$store.dispatch("firstAuthCheck");
                        this.$toast.success(resp.data.message);
                        this.loading = false;
                    } else {
                        this.$toast.error("Your given credential don not match our records");
                        this.loading = false;
                    }
                })
                .catch((error) => {
                    console.log(error);
                    this.$toast.error(error);
                    this.loading = false;
                });
        },
    },
};
</script>
<style scoped>
.v-card {
    padding: 30px !important;
}

.invalid-feedback.d-block {
    display: block;
    text-align: left;
    font-size: 13px;
    color: red;
    font-weight: 500;
    font-style: italic;
    margin-left: 5px;
}
</style>