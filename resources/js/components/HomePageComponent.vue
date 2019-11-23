<template>
  <div>
    <ul class="nav">
      <li>
        <router-link :to="{ name: 'login' }">Login</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'register' }">Register</router-link>
      </li>
    </ul>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Login from "./auth/LoginComponent";
import Register from "./auth/RegisterComponent";

export default {
  // TODO: Find a more fitting name for this component. This is going to be the base component, not just the home page
  components: {
    login: Login,
    register: Register
  },
  data() {
    return {};
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
  padding: 0 25px;
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