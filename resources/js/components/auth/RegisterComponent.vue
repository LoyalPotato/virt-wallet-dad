<template>
  <div>
    <div class="card">
      <div class="card-body">
        <h1 class="card-title text-center">{{ title }}</h1>
      </div>
    </div>
    <form action="#" @submit.prevent="register">
      <div class="form-group">
        <label for="name">Name:</label>
        <input v-bind:name="name" id="name" type="text" v-model="name" required />
      </div>

      <div class="form-group">
        <label for="email">Email:</label>
        <input v-bind:email="email" id="email" type="email" v-model="email" required />
      </div>

      <!--Nota: Vamos ter que aceitar fotos mas para testes vai um URL-->
      <div class="form-group">
        <label for="photo">Photo:</label>
        <input v-bind:photo="photo" id="photo" type="url" v-model="photo" required />
      </div>

      <div class="form-group">
        <label for="nif">Nif:</label>
        <input v-bind:nif="nif" id="nif" type="text" v-model="nif" required />
      </div>


      <div class="form-group">
        <label for="password">Password:</label>
        <input id="password" type="password" v-model="password" required />
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Register</button>
        <a class="btn btn-light" @click="cancelRegistration()">Cancel</a>
      </div>
    </form>

    <!--NOTE:  @keyup.enter="event()" para enter e faz submit? -->
  </div>
</template>

<script>
export default {
name: "RegisterComponent",
  data() {
    return {
      title: "New User Registration",
      name: "",
      password: "",
      email: "",
      photo: "",
      nif: ""
    };
  },
  methods: {
      register() {
      this.$store
        .dispatch("register", {
          email: this.email,
          password: this.password,
          name: this.name,
          photo: this.photo,
          nif: this.nif
        })
        .then(response => {
          this.$store.dispatch("registerUser").then(response => {
            console.log("Success"); //TODO Trigger success warning
            this.$router.push("/home"); //TODO user verification?
          });
          this.$router.push("/"); //NOta: duplicate?
        })
        .catch(function(error) {
          console.log(error); //TODO: Error page?
        });
    },
    cancelRegistration() {
      this.$router.push("/");
    }
  }
}
</script>

<style>

</style>
