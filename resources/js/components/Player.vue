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
    bottom: 10%;
    z-index: 5;
    }

    .player:nth-of-type(2) {
    left: 13%;
    bottom: 12%;
    z-index: 3;
    }

    .player:nth-of-type(3) {
    left: 16%;
    bottom: 14%;
    z-index: 2;
    }

    .player:nth-of-type(4) {
    left: 19%;
    bottom: 16%;
    z-index: 1;
    }

    .player:nth-of-type(5) {
        left: 19%;
        bottom: 14%;
        z-index: 2;
    }

    .player:nth-of-type(6) {
        left: 19%;
        bottom: 12%;
        z-index: 3;
    }

    .player:nth-of-type(7) {
        left: 19%;
        bottom: 10%;
        z-index: 5;
    }

    .player:nth-of-type(8) {
        left: 19%;
        bottom: 11%;
        z-index: 4;
    }

    .player-image {
        height: 70%;
        width: 70%;
    }


    @keyframes backAndForth{
        0% {
            transform:  translate(0%,0%)  scaleX(1.00) ;
        }
        17% {
            transform:  translate(15vw,-25%)  scaleX(1.00) ;
        }
        21% {
            transform:  translate(25vw,-30%)  scaleX(1.00) ;
        }
        25% {
            transform:  translate(35vw,-25%)  scaleX(1.00) ;
        }
        35% {
            transform:  translate(60vw,0%)  scaleX(1.00) ;
        }
        45% {
            transform:  translate(65vw,0%)  scaleX(1.00) ;
        }
        65% {
            transform:  translate(65vw,0%)  scaleX(-1.00) ;
        }
        99% {
            transform:  translate(0%,0%)  scaleX(-1.00) ;
        }
        100% {
            transform:  translate(0%,0%)  scaleX(1.00) ;
        }
    }
</style>
