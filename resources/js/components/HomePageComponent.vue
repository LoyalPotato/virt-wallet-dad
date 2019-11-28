<template>
  <div>
    <p>Welcome to your Home Page</p>
  </div>
</template>
<script>

export default {
  data() {
    return {};
  },
  methods: {
    
  },
  computed:{
    user(){
      return this.$store.state.user;
    },
  }
};
</script>

<style>
p{
  text-align: center;
}
</style>
