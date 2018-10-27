<template>
    <div class="project">
        <columns v-if="project !== undefined" :columns="project.columns" />
    </div>
</template>

<script>
    import Columns from "./Columns";
    export default {
        name: "Project",
        components: {
            Columns
        },
        data() {
            return {
                project: undefined,
            }
        },
        mounted() {
            axios.get(`/api/projects/${this.$route.params.slug}`).then(response => {
                console.log(response);
            }).catch(err => {
                console.err(err);
            });
        }
    }
</script>

<style scoped>
</style>
