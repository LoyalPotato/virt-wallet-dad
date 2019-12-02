<template>
  <div>
    <div class="card">
      <div class="card-body">
        <h1 class="card-title text-center">{{ title }}</h1>
      </div>
    </div>
    <form action="#" @submit.prevent="login">
        <div class="form-group">
            <label for="userName">Name:</label>
            <input v-bind:userName="name" id="userName" type="text" v-model="name" required />
        </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input v-bind:email="email" id="email" type="email" v-model="email" required />
      </div>

      <!--Nota: Guardar imagens na DB nao e facil, portanto o utilizador que mande um url :P-->
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
      title: "New User Registration",
      userName: "",
      password: "",
      email: "",
      photo: "",
      nif: ""
    };
  }
}
</script>

<style>

</style>