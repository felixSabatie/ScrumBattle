<template>
    <div v-if="mob" class="mob" :class="{'hurt' : animate}">
        <img class="mob-image" :src="mob.image">
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    export default {
        name: "Mob",
        props: [
            "animate"
        ],
        computed: {
            ...mapGetters({
                mob: 'projects/mob'
            })
        },
    }
</script>


<style lang="scss">
    @import "../../sass/app";

    .mob {
        height: 100px;
        position: absolute;
        bottom: 10%;
        right: 10%;
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
