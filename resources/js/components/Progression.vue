<template>
    <div class="progression">
        <div class="myProgress">
            <div class="myBar" ref="myBar"></div>
            <img class="user_icon" ref="user_icon" v-bind:src="imgSrc"/>
        </div>
        <br>
        <label> Percent
            <input type="text" v-model="percent"/>
        </label>
        <button @click="move">go</button>
    </div>
</template>

<script>
    export default {
        name: "Progression",
        data: function () {
            return {
                percent: 0,
            }
        },
        computed: {
            imgSrc: function () {
                return "/images/fsociety.png"
            }
        },
        methods: {
            move() {
                var elem = this.$refs.myBar;
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

<style scoped>
    .progression{
        width: 100%;
        height: 100px;
        position: relative;
    }
    .myProgress {
        width: 100%;
        background-color: #ddd;
        position: absolute;
        top: 60%;
        height: 30%;
    }

    .myBar {
        width: 1%;
        height: 100%;
        background-color: #4CAF50;
        position: absolute;
    }

    .myProgress img {
        display: block;
        position: absolute;
        top: 50%;
        left: 1%;
        max-height: 100%;
        max-width: 100%;
        transform: translate(-50%, -50%);
    }
</style>
