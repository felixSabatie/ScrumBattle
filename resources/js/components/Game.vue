<template>
    <div class="game" :class="'project-' + (project.id % 3 + 1).toString()">
        <players></players>
        <mob :animate="animateMob"></mob>
        <button @click="animate()"> Hurt </button>
    </div>
</template>

<script>
    import Mob from "./Mob";
    import Players from "./Players";

    export default {
        name: "Game",
        props: ['project'],
        components: {
            Players,
            Mob
        },
        data(){
          return{
              animateMob:false,
          }
        },
        methods: {
            animate() {
                let that = this;
                this.animateMob = true;
                this.$nextTick(() => {
                    setTimeout(function () {
                        that.animateMob = false;
                    }, 2000);
                });
            },
        }
    };
</script>

<style lang="scss">
    @import "../../sass/app";

    .game {
        height: 200px;
        width: 100%;
        background-size: auto 100%;
        background-position: left bottom;
        position: relative;

        &.project-1 {
            background-image: url("/assets/background/1.png");
        }

        &.project-2 {
            background-image: url("/assets/background/2.png");
        }

        &.project-3 {
            background-image: url("/assets/background/3.png");
        }
    }
</style>
