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
        animation: backAndForth linear 2s;
        animation-iteration-count: infinite;
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
        10% {
            transform:  translate(200%,-25%)  scaleX(1.00) ;
        }
        12% {
            transform:  translate(240%,-30%)  scaleX(1.00) ;
        }
        15% {
            transform:  translate(280%,-25%)  scaleX(1.00) ;
        }
        22% {
            transform:  translate(500%,0%)  scaleX(1.00) ;
        }
        31% {
            transform:  translate(500%,0%)  scaleX(-1.00) ;
        }
        99% {
            transform:  translate(0%,0%)  scaleX(-1.00) ;
        }
        100% {
            transform:  translate(0%,0%)  scaleX(1.00) ;
        }
    }
</style>
