<template>
    <div class="progression" :style="{height: height}">
        <div class="progress-wrapper">
            {{user.donePoints}}
            <div class="progress" ref="progress"></div>
            <img class="user_icon" ref="user_icon" :src="user.avatar"/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Progression",
        props: [
            'user',
            'height'
        ],
        data() {
            return {
                test: this.user.donePoints,
            }
        },
        mounted() {
            //this.move();
        },
        computed: {
            percent() {
                return this.user.donePoints/this.user.totalPoints;
            }
        },
        watch: {
            user() {
                console.log('changed in child');
            }
        },
        methods: {
            move() {
                var elem = this.$refs.progress;
                var icon = this.$refs.user_icon;
                var width = elem.clientWidth /elem.offsetParent.clientWidth;
                var id = setInterval(frame, 10, this.percent);
                function frame(percent) {
                    if (width >= percent) {
                        clearInterval(id);
                    } else {
                        width++;
                        elem.style.width = width + '%';
                        icon.style.left = width + '%';
                    }
                }
            }
        }

    }
</script>

<style lang=scss>
    .progression{
        width: 80%;
        position: relative;
    }
    .progress-wrapper {
        width: 100%;
        height: 100%;
        position: absolute;
    }

    .progress {
        width: 1%;
        height: 100%;
        background-color: #2abb9b;
        position: absolute;
    }

    .progress-wrapper img {
        display: block;
        position: absolute;
        top: 50%;
        left: 1%;
        max-height: 100%;
        max-width: 100%;
        transform: translate(-50%, -50%);
    }
</style>
