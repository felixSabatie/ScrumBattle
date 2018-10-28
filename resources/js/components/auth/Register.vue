<template>
    <div class="register">
        <img class="logo" src="/assets/logo.png"/>
        <form class="register-form" @submit.prevent="sendForm">
            <h2>S'inscrire</h2>
            <div class="input">
                <label for="name-input">Nom</label>
                <input type="text" id="name-input" v-model="user.name">
            </div>
            <div class="input">
                <label for="email-input">Email</label>
                <input type="email" id="email-input" v-model="user.email">
            </div>
            <div class="input">
                <div class="avatar-selector">
                    <p>Choisir votre avatar</p>
                    <div class="images-container">
                        <div class="image-container" :class="{selected: avatarIsSelected(avatar)}"
                             @click="user.avatar = avatar" v-for="avatar in avatars">
                            <img :src="avatar" :alt="avatar">
                        </div>
                    </div>
                </div>
            </div>
            <div class="input">
                <label for="password-input">Mot de passe</label>
                <input type="password" v-model="user.password" id="password-input"/>
            </div>

            <div class="buttons">
                <router-link :to="{ name: 'login' }" class="btn link">Se connecter</router-link>
                <button type="submit" class="btn">S'inscrire</button>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data() {
            return {
                user: {
                    name: "",
                    email: "",
                    password: "",
                    avatar: ""
                },
                avatars: [
                    '/assets/players/CaptainFalcon.png',
                    '/assets/players/Dk.png',
                    '/assets/players/Kirby.png',
                    '/assets/players/Link.png',
                    '/assets/players/Mario.png',
                    '/assets/players/MegaMan.png',
                    '/assets/players/Pikachu.png',
                    '/assets/players/Samus.png',
                    '/assets/players/Yoshi.png',
                ]
            };
        },
        methods: {
            sendForm() {
                axios
                .post("/api/register", {...this.user})
                .then(response => {
                    axios.post("/oauth/token", {
                        client_id: 2,
                        client_secret: "bVoOL6EAf0301wQ27sTPuebsXNCysRRnMqGi6vRz",
                        grant_type: "password",
                        username: this.user.email,
                        password: this.user.password
                    })
                    .then(response => {
                        const token = response.data.access_token;
                        this.$emit("token-received", token);
                    });
                })
                .catch(err => {
                    // TODO handle
                    console.error(err);
                });
            },
            avatarIsSelected(avatar) {
                return this.user.avatar === avatar;
            }
        }
    };
</script>

<style lang="scss">
    @import "../../../sass/app";

    .register {
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: center;
        background-image: url(/assets/background/login.png);
        background-size: auto 100%;

        .logo {
            height: 15vh;
        }

        .register-form {
            display: block;
            margin: auto;
            padding: 20px 40px;
            background-color: $white;
            border-radius: $borderRadius;
            max-width: 500px;
            max-height: 70vh;
            overflow-x: auto;

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

            .avatar-selector {
                .images-container {
                    display: flex;
                    justify-content: space-between;
                    flex-direction: row;
                    flex-wrap: wrap;

                    .image-container {
                        flex-basis: 25%;
                        padding: 10px;
                        text-align: center;

                        &.selected {
                            border: 2px solid $cyan;
                            border-radius: $borderRadius;
                            padding: 8px;
                        }

                        img {
                            max-width: 100%;
                            height: auto;
                        }
                    }

                }
            }
        }
    }
</style>
