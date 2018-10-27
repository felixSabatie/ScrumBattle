<template>
  <div class="register">
    <form class="register-form" @submit.prevent="sendForm">
      <h2>Connexion</h2>
      <div class="input">
        <label for="email-input">Email</label>
        <input type="email" id="email-input" v-model="user.username">
      </div>
      <div class="input">
        <label for="password-input">Mot de passe</label>
        <input type="password" v-model="user.password" id="password-input"/>
      </div>

      <div class="buttons">
        <button type="submit" class="btn">Connexion</button>
        <router-link :to="{ name: 'register' }" class="btn link">S'inscrire</router-link>
      </div>

    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: {
        username: '',
        password: '',
      }
    }
  },
  methods: {
    sendForm() {
      axios.post('/oauth/token', {
        'client_id': 2,
      	'client_secret': 'bVoOL6EAf0301wQ27sTPuebsXNCysRRnMqGi6vRz',
      	'grant_type': 'password',
        ...this.user
      }).then(response => {
        console.log(response.data);
      }).catch(err => {
        // TODO handle
        console.error(err);
      });
    }
  }
}
</script>

<style lang="scss">
  @import "../../../sass/app";

  .register {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: $lightGrey;

    .register-form {
      display: inline-block;
      margin: auto;
      padding: 20px 40px;
      background-color: $white;
      border-radius: $borderRadius;

      .input {
        margin: 10px 0;
        display: grid;

        label {

        }
        input {
          min-width: 400px;
        }
      }

      .buttons {
        display: flex;
        flex-direction: row;
        justify-content: space-between;

        .link {
          background-color: $teal;
        }
      }

    }

  }

</style>
