<template>
  <div>
    <div class="nav">
      <h3 v-if="userExists" id="userName">{{this.$store.state.user.name}}</h3>
      <div v-if="getToken != null">
        <!-- TODO: <div v-if="user == admin"> -->
        <!-- <router-link :to="{ name: 'logout' }">Logout</router-link> -->
        <a href="#" @click="logout">Logout</a>
      </div>
      <div v-else>
        <router-link :to="{ name: 'login' }">Login</router-link>
        <router-link :to="{ name: 'register' }">Register</router-link>
      </div>
    </div>

    <div class="container">
      <router-view></router-view>
      <!-- NOTE: O Router View faz display de todos os componentes nas rotas? -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    logout() {
      this.$store.dispatch("logout").then(response => {
        this.$router.push("/");
      });
    }
  },
  computed: {
    getToken() {
      return this.$store.state.token;
    },
    userExists() {
      return this.$store.state.user != null;
    }
  }
};
</script>

<style>
.nav {
  display: flex;
  list-style: none;
  padding: 15px 0;
  margin: 0;
  justify-content: flex-end; /*NOTE: This is what makes it stick to the right */
  background: #f5f8fa;
  border-bottom: 1px solid lightgrey;
  margin-bottom: 24px;
}

.nav a {
  color: #636b6f;
  padding: 0 10px;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: 0.1rem;
  text-decoration: none;
  text-transform: uppercase;
}

.nav a:hover {
  color: #2e3335;
}

.nav a:active {
  color: rgb(25, 0, 255);
}

#userName {
  /* position: absolute; */
  /* QUESTION: How da fuck do I get this text on the left and the other nav on the right??? */
  text-align: left;
  padding: 20px;
}
</style>