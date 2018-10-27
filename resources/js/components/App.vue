<template>
  <div id='app'>
      <router-view  @token-received='onTokenReceived'></router-view>
  </div>
</template>

<script>
import axios from '../axios-wrapper';
export default {
  name: 'App',
  mounted() {
    if (this.$cookies.isKey('user-token')) {
      let token = this.$cookies.get('user-token');
      this.storeTokenAndUser(token, true);
    } else {
      this.redirect('/login');
    }
  },
  methods: {
    onTokenReceived(token) {
      this.storeTokenAndUser(token, false);
      this.redirect('/projects/my-project');
    },
    storeTokenAndUser(token, hasUser) {
      this.$cookies.set('user-token', token);
      this.$store.commit('auth/setToken', token);

      if (hasUser) {
        const user = this.$cookies.get('user');
        this.storeUser(user);
      } else {
        this.fetchAndStoreUser(user);
      }
    },
    storeUser(user) {
      this.$store.commit('auth/setUser', user);
      this.$cookies.set('user', user);
    },
    fetchAndStoreUser() {
      axios
        .get('/api/user')
        .then(response => {
          const user = response.data;
          this.storeUser(user);
        })
        .catch(error => {
          console.error(error);
        });
    },

    redirect(path) {
      this.$router.push(path);
    }
  }
};
</script>

<style scoped>
</style>
