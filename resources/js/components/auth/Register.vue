<template>
  <div class="register">
    <form class="register-form" @submit.prevent="sendForm">
      <h2>S'inscrire</h2>
      <div class="input">
        <label for="name-input">Nom</label>
        <input type="text" id="name-input" v-model="name">
      </div>
      <div class="input">
        <label for="email-input">Email</label>
        <input type="email" id="email-input" v-model="email">
      </div>
      <div class="input">
        <label for="avatar-input">Avatar</label>
        <input type="text" v-model="avatar" id="avatar-input">
      </div>
      <div class="input">
        <label for="password-input">Mot de passe</label>
        <input type="password" v-model="password" id="password-input"/>
      </div>

      <button type="button" class="btn">S'inscrire</button>

    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      avatar: ''
    }
  },
  methods: {
    sendForm() {

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

    }

  }

</style>
