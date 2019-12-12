<template>
  <!-- <p>Welcome to your Home Page</p> -->
  <div id="content">
    <top-nav></top-nav>
    <div class="container-fluid">
      <h3 class="text-dark mb-1">Welcome to your Home Page</h3>
      <div class="d-sm-flex justify-content-between align-items-center mb-4" v-if="user != null">
        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#">
          <i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report
        </a>
      </div>
    </div>
    <footer class="bg-white sticky-footer">
      <div class="container my-auto">
        <div class="text-center my-auto copyright">
          <span>Copyright © Virtual Wallets 2019</span>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import TopNav from "./TopNavComponent.vue";

export default {
  name: "HomePageComponent",
  components: {
    TopNav
  },
  data() {
    return {};
  },
  computed: {
    getToken() {
      return this.$store.state.token;
    },
    user() {
      console.log(this.$store.state.user.name);
      
      return this.$store.state.user;
    }
  },
};
</script>

<style>
/* p {
  text-align: center;
} */
</style>
