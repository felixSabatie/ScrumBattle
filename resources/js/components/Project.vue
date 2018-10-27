<template>
    <div class="project">
        <NotFound v-if="notFound" />
        <columns v-else-if="project !== undefined" :columns="project.columns" />
        <p v-else>Chargement...</p>
    </div>
</template>

<script>
    import Columns from "./Columns";
    import NotFound from './NotFound';

    export default {
        name: "Project",
        components: {
            Columns, NotFound
        },
        data() {
            return {
                project: undefined,
                notFound: false
            }
        },
        mounted() {
            axios.get(`/api/projects/${this.$route.params.slug}`).then(response => {
                this.project = response.data;
            }).catch(err => {
                console.err(err);
            });
        }
    }
</script>

<style scoped>
</style>
