<template>
  <div id="app">
      <router-view  @token-received="onTokenReceived"></router-view>
  </div>
</template>

<script>
import axios from '../axios-wrapper';
export default {
  name: "App",
  mounted() {
    if (this.$cookies.get('user-token')) {
      let token = this.$cookies.get('user-token');
      this.onTokenReceived(token, false);
    }
  },
  methods: {
    onTokenReceived(token, fetchUser) {
      this.$cookies.set('user-token', token);
      this.$store.commit('auth/setToken', token);
      this.$router.push('/projects/my-project');
      
      axios.get('/api/user').then(response => {
        const user = response.data;
        this.$store.commit('auth/setUser', user);
        this.$cookies.set('user', user);
      }).catch(error => {
        console.error(error);
      })

    }
  }
};
</script>

<style scoped>
</style>
