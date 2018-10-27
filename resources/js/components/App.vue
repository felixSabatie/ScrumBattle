<template>
  <div id="app">
      <router-view  @token-received="onTokenReceived"></router-view>
  </div>
</template>

<script>
import axios from "../axios-wrapper";
export default {
  name: "App",
  mounted() {
    if (this.$cookies.isKey("user-token")) {
      let token = this.$cookies.get("user-token");
      this.storeTokenAndUser(token, true);
    } else {
      this.redirect("/login");
    }
  },
  methods: {
    storeTokenAndUser(token, hasUser) {
      this.$cookies.set("user-token", token);
      this.$store.commit("auth/setToken", token);

      if (hasUser) {
        const user = this.$cookies.get("user");
        this.storeUser(user);
      } else {
         axios
        .get("/api/user")
        .then(response => {
          const user = response.data;
          this.storeUser(user);
        })
        .catch(error => {
          console.error(error);
        });
      }
    },
    storeUser(user) {
      this.$store.commit("auth/setUser", user);
      this.$cookies.set("user", user);
    },
    onTokenReceived(token) {
      this.storeTokenAndUser(token, false);
      this.redirect('/projects/my-project');
    },
    redirect(path) {
      this.$router.push(path);
    }
  }
};
</script>

<style scoped>
</style>
