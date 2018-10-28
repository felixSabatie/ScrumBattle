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
            players: state => state.users.users
          })
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
                    }, 2000);
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
