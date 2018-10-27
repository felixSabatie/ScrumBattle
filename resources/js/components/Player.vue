<template>
    <div class="player">
        <img class="player-image" :src="player.image" >
    </div>
</template>

<script>
    export default {
        name: "Player",
        props: {
            player: {
                type: Object,
            }
        },
    }
</script>


<style lang="scss">
    @import "../../sass/app";
    .player {
        position: absolute;
    }
    .player:nth-of-type(1) {
    left: 10%;
    bottom: 15%;
    z-index: 2;
    }
    .player:nth-of-type(2) {
    left: 15%;
    bottom: 20%;
    z-index: 1;
    }
    .player:nth-of-type(3) {
    left: 20%;
    bottom: 15%;
    z-index: 2;
    }
    .player:nth-of-type(4) {
    left: 25%;
    bottom: 20%;
    z-index: 1;
    }
    .player-image {
        height: 100%;
        width: 100%;
    }
</style>
