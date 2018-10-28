<template lang="html">
  <div class="projects container">
    <h1>Scrum Battle</h1>
    <button @click="openCreateProjectModal" class="btn">Créer un nouveau projet</button>
    <div class="projects-container" v-if="projects.length > 0">
      <div class="project" v-for="project in projects" :key="project.id" @click="navigateToProject(project.slug)">
        <img src="/assets/background/jungle.png" alt="background">
        <p>{{project.name}}</p>
      </div>
    </div>

    <modal v-if="showModal" @close="closeModal" class="modal">
      <div slot="header">
        <h1>Créer un projet</h1>
      </div>

      <div slot="body">
        Coucou
      </div>

      <div slot="footer">

      </div>
    </modal>
  </div>
</template>

<script>
import axios from '../axios-wrapper';
import Modal from './Modal';

export default {
  data() {
    return {
      projects: [],
      showModal: false,
      name: "",
      mob_id: undefined,
      users: [],
      usersFromBack: [],
      mobsFromBack: []
    }
  },
  components: {Modal},
  mounted() {
    axios.get('/api/projects/create').then(response => {
      this.usersFromBack = response.data.users;
      this.mobsFromBack = response.data.mobs;
      axios.get('/api/projects').then(response2 => {
        this.projects = response2.data;
      }).catch(err => {
        console.error(err);
      });
    }).catch(err => {
      console.error(err);
    })
  },
  methods: {
    navigateToProject(projectSlug) {
      this.$router.push({name: 'project', params: {slug: projectSlug}});
    },
    openCreateProjectModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
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
