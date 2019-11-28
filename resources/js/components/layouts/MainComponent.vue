<template>
  <div>
    <ul class="nav">
      <div v-if="getToken != null">
        <!-- NOTE: <div v-if="user == admin"> -->

        <!-- </div> -->
        <li>
          <!-- <router-link :to="{ name: 'logout' }">Logout</router-link> -->
          <a @click="logout">Logout</a>
        </li>
      </div>
      <div v-else>
        <li>
          <router-link :to="{ name: 'register' }">Register</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'login' }">Login</router-link>
        </li>
      </div>
    </ul>
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
</style>