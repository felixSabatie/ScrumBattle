<template>
    <div class="game" :class="'project-' + (project.id % 3 + 1).toString()">
        <players></players>
        <mob :animate="animateMob"></mob>
    </div>
</template>

<script>
    import Mob from "./Mob";
    import Players from "./Players";
    import { mapState } from "vuex";

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
        computed: {
            ...mapState({
                users: state => state.users.users
            }),
            players() {
                return JSON.parse(JSON.stringify(this.users));
            }
        },
        watch: {
            players(newUsers, oldUsers) {
                let animate = false;
                for(let user of newUsers) {
                    let oldUser = oldUsers.find(oldUser => oldUser.id === user.id);
                    if(oldUser.done_points < user.done_points) {
                        animate = true;
                    }
                }

                if(animate) {
                    this.animate();
                }
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
