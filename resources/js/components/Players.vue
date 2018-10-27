<template>
    <div class="players">
        <player v-for="player in players" :player="player" :key="player.id"/>
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
                players: []
            };
        },
        mounted() {
            this.players = [
                //TODO : change with backend call
                {
                    id: 1,
                    name: "First player",
                    image: '/assets/player.png',
                },
                {
                    id: 2,
                    name: "Second player",
                    image: '/assets/imp.png',
                },
                {
                    id: 3,
                    name: "Third player",
                    image: '/assets/knight.png',
                },
                {
                    id: 4,
                    name: "Fourth player",
                    image: '/assets/player.png',
                }
            ]
        }
    }
</script>

<style lang="scss">
    @import "../../sass/app";
    .players {
    }
</style>
