<template>
    <div v-if="mob && project" class="mob">
        <img class="mob-image" :src="mob.image" :class="{'hurt' : animate}">
        <div class="progression-bar">
            <div class="progression" :style="{width: percentage}"></div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    export default {
        name: "Mob",
        data() {
            return {
                percentage: '100%'
            }
        },
        props: [
            "animate"
        ],
        computed: {
            ...mapGetters({
                mob: 'projects/mob',
                currentProject: 'projects/project'
            }),
            project() {
                return JSON.parse(JSON.stringify(this.currentProject));
            },
        },
        methods: {
            updatePercentage() {
                let percentage;
                if(this.project.total_points === 0) {
                    percentage = 100;
                }
                else {
                    percentage = 100 - ((this.project.done_points / this.project.total_points) * 100);
                }
                this.percentage = `${percentage}%`;
            }
        },
        watch: {
            animate(doAnimation) {
                if(doAnimation) {
                    this.updatePercentage()
                }
            },
            project(newProject, oldProject) {
                if(newProject.done_points < oldProject.done_points) {
                    this.updatePercentage();
                }
            }
        }
    }
</script>


<style lang="scss">
    @import "../../sass/app";

    .mob {
        height: 160px;
        position: absolute;
        bottom: 10%;
        right: 10%;

        .progression-bar {
            position: relative;
            background-color: rgba(0, 0, 0, .7);
            border-radius: $borderRadius;
            width: 100%;
            height: 10px;

            .progression {
                height: 100%;
                background-color: $red;
                border-radius: $borderRadius;
                transition: width .5s ease-in-out;
            }
        }
    }

    .mob-image {
        height: 100%;
    }

    .hurt {
        animation: hurt linear 0.2s;
        animation-iteration-count: 10;
    }

    @keyframes hurt {
        0% {
            transform: translate(0%, 0%) scaleX(1.00);
        }
        50% {
            transform: translate(2%, -2%) scaleX(0.9);
            filter: opacity(25%);
        }
        100% {
            transform: translate(0%, 0%) scaleX(1.00);
        }
    }
</style>
