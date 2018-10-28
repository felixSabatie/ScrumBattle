<template>
    <div class="progression" :style="{height: progression.height}">
        <div class="progress-wrapper">
            <div class="progress" ref="progress"></div>
            <img class="user_icon" ref="user_icon" :src="progression.image"/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Progression",
        props: {
            progression: {
                type: Object,
            },
        },
        data() {
            return {
                percent: this.progression.percent,
            }
        },
        mounted: function () {
            this.move();
        },
        watch: {
            percent: {
                handler() {
                    this.move();
                }
            }
        },
        methods: {
            move() {
                var elem = this.$refs.progress;
                var icon = this.$refs.user_icon;
                var width = elem.clientWidth /elem.offsetParent.clientWidth;
                console.log(this.percent);
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

<style scoped>
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
