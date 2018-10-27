<template>
  <div id="app">
      <router-view  @token-received="onTokenReceived"></router-view>
  </div>
</template>

<script>
export default {
  name: "App",
  mounted() {
    if (this.$cookies.get('user-token')) {
      let token = this.$cookies.get('user-token');
      this.onTokenReceived(token);
    }
  },
  methods: {
    onTokenReceived(token) {
      this.$cookies.set('user-token', token);
      this.$store.commit("auth/setToken", token);
      this.$router.push("/projects/my-project");
    }
  }
};
</script>

<style scoped>
</style>
