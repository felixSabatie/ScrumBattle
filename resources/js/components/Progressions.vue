<template>
    <div class="progressions">
        <progression v-for="progression in progressions" :progression="progression" :key="progression.id"/>
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
                progressions: []
            }
        },
        mounted() {
            this.progressions = [
                //@Todo: backend call
                {
                    id: 1,
                    image: '/images/user1.png',
                    percent: 25,
                },
                {
                    id: 2,
                    image: '/images/user2.png',
                    percent: 35,
                },
                {
                    id: 3,
                    image: '/images/user3.png',
                    percent: 45,
                },

            ]
        }
    }
</script>

<style scoped>

</style>
