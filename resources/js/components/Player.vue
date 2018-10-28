<template>
    <div class="player" :class="{'back-and-forth' : animate}">
        <img class="player-image" :src="player.avatar" >
    </div>
</template>

<script>
    export default {
        name: "Player",
        props: [
            "player",
            "animate"
        ],
    }
</script>


<style lang="scss">
    @import "../../sass/app";
    .player {
        position: absolute;
    }

    .back-and-forth{
        animation: backAndForth linear 1.3s;
        animation-iteration-count: 1;
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


    @keyframes backAndForth{
        0% {
            transform:  translate(0%,0%)  scaleX(1.00) ;
        }
        17% {
            transform:  translate(40vw,-25%)  scaleX(1.00) ;
        }
        21% {
            transform:  translate(50vw,-30%)  scaleX(1.00) ;
        }
        25% {
            transform:  translate(60vw,-25%)  scaleX(1.00) ;
        }
        35% {
            transform:  translate(90vw,0%)  scaleX(1.00) ;
        }
        45% {
            transform:  translate(85vw,0%)  scaleX(1.00) ;
        }
        65% {
            transform:  translate(85vw,0%)  scaleX(-1.00) ;
        }
        99% {
            transform:  translate(0%,0%)  scaleX(-1.00) ;
        }
        100% {
            transform:  translate(0%,0%)  scaleX(1.00) ;
        }
    }
</style>
