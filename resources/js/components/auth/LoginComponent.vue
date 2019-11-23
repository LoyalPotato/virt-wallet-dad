<template>
  <div>
    <div class="card">
      <div class="card-body">
        <h1 class="card-title text-center">{{ title }}</h1>
      </div>
    </div>
    <!-- NOTE:
    loginComp
    O logout vai ser um botao que executa uma funçao que faz um pedido post para fazer logout?
    -->

    <div class="form-group">
      <label for="email">Email:</label>
      <input v-bind:email=email id="email" type="text" />
    </div>

    <div class="form-group">
      <label for="password">Password:</label>
      <input id="password" type="password"/>
    </div>

    <div class="form-group">
      <a class="btn btn-primary" @click="login()">Login</a>
      <a class="btn btn-light" @click="cancelLogin()">Cancel</a>
    </div>

    <!--NOTE:  @keyup.enter="event()" para enter e faz submit? -->
  </div>
</template>

<script>
export default {
  props: ["router"],

  data() {
    return {
      title: "Login",
      password: '',
      email: '',
    };
  },
  methods: {
    login() {
      //   axios.post("/api/login", {});
      //NOTE: No then temos que atribuir à variavel Vuex o valor do token
      console.log(this.$store.state.user);
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
