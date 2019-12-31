<template>
  <div id="wrapper">
    <nav
      class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0"
    >
      <div class="container-fluid d-flex flex-column p-0">
        <router-link
          class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
          :to="{name: 'start'}"
        >
          <!-- NOTE: ICON -->
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text m-0">
            <span>Virtual Wallets</span>
          </div>
        </router-link>
        <hr class="sidebar-divider my-0" />
        <ul class="nav navbar-nav text-light" id="accordionSidebar">
          <li class="nav-item" role="presentation" v-if="getToken != null">
            <router-link class="nav-link active" :to="{ name: 'home' }">
              <i class="fas fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </router-link>
            <!-- <a class="nav-link active" href="index.html"></a> TEST-->
          </li>
          <!-- <li class="nav-item" role="presentation">
            <a class="nav-link" href="profile.html">
              <i class="fas fa-user"></i>
              <span>Profile</span>
            </a>
          </li> DEV_ONLY -->
          <!-- <li class="nav-item" role="presentation">
            <a class="nav-link" href="table.html">
              <i class="fas fa-table"></i>
              <span>Table</span>
            </a>
          </li> DEV_ONLY-->
          <li class="nav-item" role="presentation" v-if="getToken == null">
            <router-link class="nav-link" :to="{ name: 'login' }">
              <i class="far fa-user-circle"></i>
              <span>Login</span>
            </router-link>
          </li>
          <li class="nav-item" role="presentation" v-if="getToken == null">
            <router-link class="nav-link" :to="{ name: 'register' }">
              <i class="fas fa-user-circle"></i>
              <span>Register</span>
            </router-link>
          </li>
        </ul>
        <div class="text-center d-none d-md-inline">
          <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
        </div>
      </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
      <router-view></router-view>
      <!-- NOTE: O Router View faz display de todos os componentes nas rotas? -->
      <!-- TODO: <div v-if="user == admin"> -->
      <!-- <router-link :to="{ name: 'logout' }">Logout</router-link> -->
    </div>
  </div>
</template>

<script>
export default {
  name: "MainComponent",
  data() {
    return {};
  },
  computed: {
    getToken() {
      return this.$store.state.token;
    },
  }
};
</script>

<style>

</style>
