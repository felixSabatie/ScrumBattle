<template>
    <div class="game">
        <players></players>
        <mob></mob>
    </div>
</template>

<script>
    import Mob from "./Mob";
    import Players from "./Players";
    export default {
        name: "Game",
        props: {
            column: {
                type: Object
            }
        },
        components: {
            Players,
            Mob
        },
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
