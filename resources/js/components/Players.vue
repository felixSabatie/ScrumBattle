<template>
    <div class="players" v-if="players">
        <player v-if="animations.length > 0" v-for="player in players" :player="player" :animate="getAnimate(player.id)" :key="player.id"/>
    </div>
</template>

<script>
    import Player from "./Player";
    import { mapState } from "vuex";

    export default {
        name: "Players",
        components: {
            Player
        },
        data() {
            return {
                animations: [],
            };
        },
        computed: {
          ...mapState({
            users: state => state.users.users
          }),
          players() {
            return JSON.parse(JSON.stringify(this.users));
          }
        },
        watch: {
          players(newUsers, oldUsers) {
              let usersToAnimate = [];
              newUsers.forEach(user => {
                let oldUser = oldUsers.find(oldUser => oldUser.id === user.id);
                if(oldUser.done_points < user.done_points) {
                  usersToAnimate.push(user);
                }
              });

              if(usersToAnimate.length > 0) {
                this.animatePlayers(usersToAnimate);
              }
          }
        },
        mounted() {
            this.players.forEach(player => {
                this.animations.push({
                    id: player.id,
                    animate: false,
                });
            });
        },
        methods : {
            animatePlayers(players){
                let that = this;
                players.forEach(player =>{
                    this.animations.find(el => el.id === player.id).animate = true;
                });
                this.$nextTick(()=>{
                    setTimeout(function() {
                        players.forEach(player =>{
                            that.animations.find(el => el.id === player.id).animate = false;
                        });
                    }, 1500);
                });
            },
            getAnimate(playerId) {
                return this.animations.find(el => el.id === playerId).animate;
            }
        }
    }
</script>

<style lang="scss">
    @import "../../sass/app";

    .players {
        height: 100%;
    }
</style>
