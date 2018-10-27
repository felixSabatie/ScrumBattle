<template lang="html">
  <div class="projects container">
    <h1>Scrum Battle</h1>
    <div class="projects-container" v-if="projects.length > 0">
      <div class="project" v-for="project in projects" :key="project.id" @click="navigateToProject(project.slug)">
        <img :src="project.mob.image" alt="background">
        <p>{{project.name}}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from '../axios-wrapper';

export default {
  data() {
    return {
      projects: []
    }
  },
  mounted() {
    axios.get('/api/projects').then(response => {
      this.projects = response.data;
    }).catch(err => {
      console.error(err)
    });
  },
  methods: {
    navigateToProject(projectSlug) {
      this.$router.push({name: 'project', params: {slug: projectSlug}});
    }
  }
}
</script>

<style lang="scss">
@import "../../sass/app";

.projects {


  .projects-container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-around;
    align-items: flex-start;

    .project {
      margin: 10px 5px;
      flex-basis: 250px;
      height: 110px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      cursor: pointer;

      p {
        text-align: center;
        font-weight: bold;
        color: $white;
        font-size: 23px;
      }

      img {
        display: block;
        position: absolute;
        z-index: -1;
        border-radius: $borderRadius;
        filter: brightness(.7);
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        max-width: 100%;
        height: auto;
      }
    }
  }

}
</style>
