<template>
    <div class="project">
        <NotFound v-if="notFound" />
        <div class="project-content" v-else-if="project !== undefined">
          <Game :project="project" />
          <div class="columns-container">
            <Columns :columns="project.columns" />
          </div>
          <div class="permissions-container">
            <Progressions />
          </div>
        </div>
        <p v-else>Chargement...</p>
    </div>
</template>

<script>
    import Columns from "./Columns";
    import NotFound from './NotFound';
    import Game from './Game';
    import Progressions from './Progressions';
    import axios from '../axios-wrapper';

    export default {
        name: "Project",
        components: {
            Columns, NotFound, Game, Progressions
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
                this.$store.commit('projects/setProject', this.project)
            }).catch(err => {
                this.notFound = true;
            });
        }
    }
</script>

<style lang="scss">
.project {
  height: 100vh;
  width: 100vw;
  overflow: hidden;

  .project-content {
    display: flex;
    flex-direction: column;
    height: 100%;

    .columns-container {
      flex-grow: 1;
      display: flex;
      flex-direction: column;

      position: relative;
    }

    .permissions-container {
      height: 100px;
    }
  }
}
</style>
