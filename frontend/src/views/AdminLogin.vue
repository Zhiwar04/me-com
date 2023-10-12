<script>
import Form from "vform";
import { toast } from "vue3-toastify";

import CustomInput from "@/components/UI/CustomInput.vue";
export default {
  components: {
    CustomInput,
  },
  name: "AdminLogin",
  data: () => ({
    form: new Form({
      email: "",
      password: "",
    }),
  }),
  computed: {
    user() {
      return this.$store.state.auth.user;
    },
    token() {
      return this.$store.state.token;
    },
  },
  methods: {
    async login() {
      const response = await this.form
        .post("http://127.0.0.1:8000/api/login", this.data)
        .then((response) => {
          this.data = response.data;
          localStorage.setItem("token", response.data.token);
          this.$store.dispatch("auth/setUser", response.data.user);
          this.$store.dispatch("auth/setToken", response.data.token);
          toast.success("Login Successfull");
          setTimeout(() => {
            this.$router.replace({ name: "admin.dashboard" });
            this.$axios.defaults.headers.common["Authorization"] =
              "Bearer " + localStorage.getItem("token");
          }, 1000);
        });
    },
  },
};
</script>
<template>
  <div class="page-content pt-145 pb-150">
    <div class="container">
      {{ user }}
      {{ token }}
      <div class="row">
        <div
          class="col-xl-8 p-5 mt-10 bg-white rounded-md mx-auto col-lg-12 col-md-12"
        >
          <div class="row">
            <div class="col-lg-6 pr-30 d-none d-lg-block">
              <img
                class="border-radius-15"
                src="/assets/interface/imgs/login.jpg"
                alt=""
              />
            </div>
            <div class="col-lg-6 col-md-8">
              <div class="login_wrap widget-taber-content background-white">
                <div class="padding_eight_all">
                  <div class="heading_s1">
                    <h1 class="mb-5 text-3xl font-bold">Login</h1>
                    <p class="mb-30">
                      Don't have an account?
                      <router-link
                        :to="{ name: 'register' }"
                        class="text-blue-500"
                        >Create here</router-link
                      >
                    </p>
                  </div>
                </div>
                <form @submit.prevent="login">
                  <div class="form-group">
                    <custom-input
                      name="email"
                      title="email"
                      id="email"
                      v-model="form.email"
                      type="email"
                    ></custom-input>
                  </div>
                  <div
                    v-if="form.errors.has('email')"
                    v-html="form.errors.get('email')"
                  />

                  <div class="form-group">
                    <custom-input
                      name="password"
                      id="password"
                      title="password"
                      v-model="form.password"
                      type="password"
                    ></custom-input>
                  </div>
                  <div
                    v-if="form.errors.has('password')"
                    v-html="form.errors.get('password')"
                  />
                  <div class="login_footer form-group mb-50">
                    <div class="chek-form">
                      <div class="custome-checkbox">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          name="checkbox"
                          id="exampleCheckbox1"
                          value=""
                        />
                        <label class="form-check-label" for="exampleCheckbox1"
                          ><span>Remember me</span></label
                        >
                      </div>
                    </div>
                    <a class="text-muted" href="{{ route('password.request') }}"
                      >Forgot password?</a
                    >
                  </div>
                  <div class="form-group">
                    <button
                      type="submit"
                      class="btn btn-heading btn-block hover-up"
                      name="login"
                    >
                      Log in
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped></style>
