<template>
  <!-- <p>Welcome to your Home Page</p> -->
  <div id="content">
    <top-nav></top-nav>
    <div class="container-fluid">
      <div
        class="d-sm-flex justify-content-between align-items-center mb-4"
        v-if="user != null && user.type == 'o'"
      >
        <h3 class="text-dark mb-1">Welcome {{user.name}}</h3>
        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#" @click.prevent="rNewInc()">
          <i class="fas fa-sm text-white-50"></i>&nbsp; Register New Income
        </a>
      </div>
      <r-inc v-if="newIncome"></r-inc>
    </div>

    <div class="container-fluid">
      <ul>
        <li v-for="movement in movements" class="row"> {{movement}}</li>
      </ul>
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
    return {
      newIncome: false,
    };
  },
  methods: {
    rNewInc() {
      this.newIncome = true;
    },
  },
  computed: {
    getToken() {
      return this.$store.state.token;
    },
    user() {
      return this.$store.state.user;
    },
    movements() {
      this.$store.dispatch("getMovements")
        .then(response => {
          this.movements = this.$store.state.movements;
      })
        .catch(error => {
          this.$toasted.show("Failed getting movements.", {
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
    }
  }
};
</script>

<style>
/* p {
  text-align: center;
} */
</style>
