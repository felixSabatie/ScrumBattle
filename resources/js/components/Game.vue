<template>
    <div class="game">
        <div>
            <mob></mob>
        </div>
    </div>
</template>

<script>
    import Mob from "./Mob";
    export default {
        name: "Game",
        components: {
            Mob
        },
        props: {
            column: {
                type: Object
            }
        }
    };
</script>

<style scoped>
</style>
