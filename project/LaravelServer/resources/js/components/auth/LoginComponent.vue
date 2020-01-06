<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-9 col-lg-12 col-xl-10">
        <div class="card shadow-lg o-hidden border-0 my-5">
          <div class="card-body p-0">
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-flex">  DEV_ONLY 'E a img
                <div 
                  class="flex-grow-1 bg-login-image"
                  style="background-image: url(&quot;assets/img/dogs/image3.jpeg&quot;);" 
                ></div>
              </div>-->
              <div class="col-lg-6 offset-lg-3">
                <div class="p-5">
                  <div class="text-center">
                    <h4 class="text-dark mb-4">Welcome Back!</h4>
                  </div>
                  <form class="user" action="#" @submit.prevent="login">
                    <div class="form-group">
                      <input
                        class="form-control form-control-user"
                        type="email"
                        id="email"
                        aria-describedby="emailHelp"
                        placeholder="Enter Email Address..."
                        name="email"
                        v-model="email"
                        required
                      />
                    </div>
                    <div class="form-group">
                      <input
                        class="form-control form-control-user"
                        type="password"
                        id="password"
                        placeholder="Password"
                        name="password"
                        v-model="password"
                      />
                    </div>
                    <button
                      class="btn btn-primary btn-block text-white btn-user"
                      type="submit"
                    >Login</button>
                    <hr />
                  </form>
                  <!-- <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div> DEV_ONLY-->
                  <div class="text-center">
                    <router-link class="small" :to="{ name: 'register'}">Create an Account!</router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginComponent",
  data() {
    return {
      password: "",
      email: ""
    };
  },
  methods: {
    login() {
      this.$store
        .dispatch("login", {
          email: this.email,
          password: this.password
        })
        .then(response => {
          this.$store.dispatch("getAuthUser").then(response => {
            this.$toasted.show("Login successful", {
              action: {
                text: "X",
                onClick: (e, toastObject) => {
                  toastObject.goAway(0);
                }
              },
              position: "bottom-center",
              duration: 2000,
              type: "success"
            });
            this.$router.push("/home");
          });
        })
        .catch(error => {
          this.$toasted.show("Login failed", {
            action: {
              text: "X",
              onClick: (e, toastObject) => {
                toastObject.goAway(0);
              }
            },
            position: "bottom-center",
            duration: 2000,
            type: "error"
          });
        });
    },
    cancelLogin() {
      this.$router.push("/");
    }
  }
};
</script>

<style>
.form-group {
  text-align: center;
  padding-top: 10px;
}
</style>
