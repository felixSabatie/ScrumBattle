<template>
    <div class="game">
        <mob></mob>
    </div>
</template>

<script>
    import Mob from "./Mob";
    export default {
        name: "Game",
        props: {
            column: {
                type: Object
            }
        },
        components: {
            Mob
        },
        getBackground() {
            return "";
        }
    };
</script>

<style lang="scss">
    @import "../../sass/app";
    .game {
        height: 200px;
        width: 100%;
        background-image: url("/assets/background/jungle.png");
        background-size: auto 100%;
        background-position: left bottom;
        position: relative;
    }
</style>
