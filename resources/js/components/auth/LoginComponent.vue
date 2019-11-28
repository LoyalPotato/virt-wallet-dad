<template>
  <div>
    <div class="card">
      <div class="card-body">
        <h1 class="card-title text-center">{{ title }}</h1>
      </div>
    </div>
    <form action="#" @submit.prevent="login">
      <div class="form-group">
        <label for="email">Email:</label>
        <input v-bind:email="email" id="email" type="text" v-model="email" required />
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input id="password" type="password" v-model="password" required />
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Login</button>
        <a class="btn btn-light" @click="cancelLogin()">Cancel</a>
      </div>
    </form>

    <!--NOTE:  @keyup.enter="event()" para enter e faz submit? -->
  </div>
</template>

<script>
export default {
  name: "LoginComponent",
  data() {
    return {
      title: "Login",
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
            console.log("Success"); //TODO Trigger success warning
            this.$router.push("/home");
          });
        })
        .catch(function(error) {
          console.log(error);
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
