<template>
    <div class="project">
        <NotFound v-if="notFound" />
        <div class="project-content" v-else-if="project !== undefined">
          <router-link :to="{ name: 'projects' }" class="btn return-button"><i class="material-icons">arrow_back</i>Projets</router-link>
          <div class="project-name-container">
            <div class="project-name">
              {{project.name}}
            </div>
          </div>
          <Game :project="project" />
          <div class="columns-container">
            <Columns :columns="project.columns" :project="project" />
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
import NotFound from "./NotFound";
import Game from "./Game";
import Progressions from "./Progressions";
import axios from "../axios-wrapper";

export default {
  name: "Project",
  components: {
    Columns,
    NotFound,
    Game,
    Progressions
  },
  data() {
    return {
      project: undefined,
      notFound: false
    };
  },
  mounted() {
    axios
      .get(`/api/projects/${this.$route.params.slug}`)
      .then(response => {
        this.project = response.data;

        this.$store.commit("projects/setProject", this.project);
        this.$store.commit("users/setUsers", this.project.users);
        this.$store.commit(
          "cards/setCards",
          this.project.columns.flatMap(col => col.cards)
        );
      })
      .catch(err => {
        this.notFound = true;
      });
  }
};
</script>

<style lang="scss">
@import "../../sass/app";

.project {
  height: 100vh;
  width: 100vw;
  overflow: hidden;

  .return-button {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 10;
    display: flex;
    align-items: center;
  }

  .project-name-container {
    position: absolute;
    z-index: 10;
    left: 50%;
    transform: translateX(-50%);
    top: 10px;
    color: $white;
    font-size: 20px;

    .project-name {
      padding: 10px;
      background-color: rgba(0, 0, 0, .5);
      border-radius: $borderRadius;
    }
  }

  .project-content {
    display: flex;
    flex-direction: column;
    height: 100%;

    .columns-container {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      background-color: $white;

      position: relative;
    }

    .permissions-container {
      height: 100px;
    }
  }
}
</style>
