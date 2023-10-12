<template>
  <main class="main pages mt20">
    <div class="page-content pt-150 pb-150">
      <div class="container">
        <div class="row">
          <div class="col-xl-10 col-lg-10 col-md-12 m-auto">
            <div class="row">
              <div class="col-lg-7 col-md-8">
                <div class="login_wrap widget-taber-content background-white">
                  <div class="padding_eight_all">
                    <div class="heading_s1">
                      <h1 class="mb-5 text-3xl font-bold">Create an Account</h1>
                      <p class="mb-10">
                        Already have an account?
                        <router-link
                          class="text-red-500"
                          :to="{ name: 'login' }"
                          >Login</router-link
                        >
                      </p>
                    </div>
                    <form method="POST" @submit.prevent="register">
                      <div class="form-group">
                        <custom-input
                          type="text"
                          id="name"
                          title="Username"
                          name="name"
                          placeholder="Username"
                          v-model.trim="form.name"
                        />
                        <div
                          v-if="form.errors.has('name')"
                          v-html="form.errors.get('name')"
                          class="text-red-600"
                        />
                      </div>
                      <div class="form-group">
                        <custom-input
                          name="email"
                          title="email"
                          id="email"
                          placeholder="Email"
                          v-model="form.email"
                          type="email"
                        ></custom-input>
                        <div
                          v-if="form.errors.has('email')"
                          v-html="form.errors.get('email')"
                          class="text-red-600"
                        />
                      </div>
                      <div class="form-group">
                        <custom-input
                          name="password"
                          id="password"
                          title="password"
                          placeholder="Password"
                          v-model="form.password"
                          type="password"
                        ></custom-input>
                        <div
                          v-if="form.errors.has('password')"
                          v-html="form.errors.get('password')"
                          class="text-red-600"
                        />
                      </div>
                      <div class="form-group">
                        <custom-input
                          id="password_confirmation"
                          type="password"
                          name="password_confirmation"
                          placeholder="password_confirmation"
                          title="password_confirmation"
                          v-model="form.password_confirmation"
                        />
                        <div
                          v-if="form.errors.has('password_confirmation')"
                          v-html="form.errors.get('password_confirmation')"
                          class="text-red-600"
                        />
                      </div>

                      <div class="login_footer form-group mb-50">
                        <div class="chek-form">
                          <div class="custome-checkbox">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              name="checkbox"
                              id="exampleCheckbox12"
                              value=""
                            />
                            <label
                              class="form-check-label"
                              for="exampleCheckbox12"
                              ><span
                                >I agree to terms &amp; Policy.</span
                              ></label
                            >
                          </div>
                        </div>
                        <a href="page-privacy-policy.html"
                          ><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean
                          more</a
                        >
                      </div>
                      <div class="form-group mb-30">
                        <button
                          type="submit"
                          class="btn btn-fill-out btn-block hover-up font-weight-bold"
                          name="login"
                        >
                          Submit &amp; Register
                        </button>
                      </div>
                      <p class="font-xs text-muted">
                        <strong>Note:</strong>Your personal data will be used to
                        support your experience throughout this website, to
                        manage access to your account, and for other purposes
                        described in our privacy policy
                      </p>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 pr-30 mt-32 d-none d-lg-block">
                <div class="card-login mt-115">
                  <a href="#" class="social-login facebook-login">
                    <img
                      src="assets/imgs/theme/icons/logo-facebook.svg"
                      alt=""
                    />
                    <span class="text-white">Continue with Facebook</span>
                  </a>
                  <a href="#" class="social-login google-login">
                    <img src="assets/imgs/theme/icons/logo-google.svg" alt="" />
                    <span>Continue with Google</span>
                  </a>
                  <a href="#" class="social-login apple-login">
                    <img src="assets/imgs/theme/icons/logo-apple.svg" alt="" />
                    <span>Continue with Apple</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
<script>
import Form from "vform";
import CustomInput from "@/components/UI/CustomInput.vue";
export default {
  name: "UserRegister",
  components: {
    CustomInput,
  },
  data: () => ({
    form: new Form({
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    }),
  }),

  methods: {
    async register() {
      const response = await this.form
        .post("http://127.0.0.1:8000/api/register", this.data)
        .then((response) => {
          console.log(response);
          localStorage.setItem("token", response.data.token);
          this.$store.dispatch("auth/setUser", response.data.user);
          this.form.reset();
          this.$router.replace({ name: "home" });
        });
    },
  },
};
</script>
<style scoped>
.card-login {
  padding: 50px;
  border-radius: 15px;
  border: 1px solid #ececec;
  margin-left: 30px;
}
.card-login .social-login {
  font-size: 20px;
  font-weight: 700;
  font-family: "Quicksand", sans-serif;
  display: flex;
  align-items: center;
  width: 100%;
  padding: 15px 25px;
  border-radius: 10px;
  margin-bottom: 20px;
  transition: 0.3s;
}
.card-login .social-login img {
  min-width: 28px;
  max-width: 28px;
  margin-right: 15px;
}
.card-login .social-login.facebook-login {
  background-color: #1877f2;
  color: #fff;
}
.card-login .social-login.google-login {
  background-color: #fff;
  color: #7e7e7e;
  border: 1px solid #f2f3f4;
}
.card-login .social-login.apple-login {
  background-color: #000000;
  color: #fff;
  margin-bottom: 0;
}
.card-login .social-login:hover {
  transform: translateY(-3px);
  transition: 0.3s;
  box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.05);
}
</style>
