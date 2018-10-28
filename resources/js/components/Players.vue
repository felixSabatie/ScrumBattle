<template>
    <div class="players">
        <player v-for="player in players" :player="player" :animate="getAnimate(player.id)" :key="player.id"/>
        <button @click="animatePlayers([players[0], players[1]])"> Attack </button>
    </div>
</template>

<script>
    import Player from "./Player";

    export default {
        name: "Players",
        components: {
            Player
        },
        data() {
            return {
                players: [],
                animations: [],
            };
        },
        mounted() {
            this.players = [
                //TODO : change with backend call
                {
                    id: 1,
                    name: "First player",
                    image: '/assets/players/CaptainFalcon.png',
                },
                {
                    id: 2,
                    name: "Second player",
                    image: '/assets/players/Dk.png',
                },
                {
                    id: 3,
                    name: "Third player",
                    image: '/assets/players/Mario.png',
                },
                {
                    id: 4,
                    name: "Fourth player",
                    image: '/assets/players/Pikachu.png',
                },
                {
                    id: 5,
                    name: "Fourth player",
                    image: '/assets/players/MegaMan.png',
                },
                {
                    id: 6,
                    name: "Fourth player",
                    image: '/assets/players/Samus.png',
                }
            ];
            this.players.forEach(player => {
                this.animations.push({
                    id: player.id,
                    animate: false,
                });
            })
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
