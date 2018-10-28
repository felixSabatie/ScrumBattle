<template>
    <div class="progressions">
        <progression v-for="progression in progressions" :progression="progression" :key="progression.id"/>
        <div class="goal_wrapper">
            <img v-bind:src="goal_img"/>
        </div>
    </div>
</template>

<script>
    import Progression from "./Progression";
    export default {
        name: "Progressions",
        components: {
            Progression
        },
        data() {
            return {
                progressions: [],
                goal_img: "",
            }
        },
        mounted() {
            this.goal_img = "/images/goal_flag.png";
            var nbProgressions = 3;
            var _height = (100 / nbProgressions) + "%";
            this.progressions = [
                //@Todo: backend call
                {
                    id: 1,
                    image: '/images/user1.png',
                    percent: 25,
                    height: _height,
                },
                {
                    id: 2,
                    image: '/images/user2.png',
                    percent: 35,
                    height: _height,
                },
                {
                    id: 3,
                    image: '/images/user3.png',
                    percent: 45,
                    height: _height,
                },

            ]
        }
    }
</script>

<style scoped>
.progressions {
    height: 100%;
    width: 100%;
    background-color: #a0ebef;
    position: relative;
}
.goal_wrapper {
    position: absolute;
    width: 20%;
    height: 100%;
    right: 0%;
    top: 0%;
}.goal_wrapper img {
     position: absolute;
     max-height: 100%;
     max-width: 100%;
     display: inline-block;
     left: 20%;
 }

</style>
