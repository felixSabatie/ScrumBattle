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
        <label for="name-input">Nom du projet</label>
        <input type="text" id="name-input" v-model.trim="project.name">
        <div class="mob-selector">
          <p>Choisir l'adversaire à affronter</p>
          <div class="images-container">
            <div class="image-container" :class="{selected: mobIsSelected(mob.id)}" @click="project.mob_id = mob.id" v-for="mob in mobs">
              <img :src="mob.image" :alt="'mob-' + mob.id">
            </div>
          </div>
        </div>

        <div v-for="user in users" class="modal-user">
          <div class="modal-user-image">
            <img :src="user.avatar" alt="user avatar">
          </div>
          <div class="modal-user-info">
            {{user.name}}
          </div>
          <div class="modal-user-check">
            <input type="checkbox" :checked="userIsSelected(user.id)" :value="user.id" @click="handleCheck">
          </div>
        </div>
      </div>

      <div slot="footer">
        <button class="btn" @click="sendProject">Valider</button>
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
      project: {
        name: "",
        mob_id: undefined,
        users: []
      },
      users: [],
      mobs: []
    }
  },
  components: {Modal},
  mounted() {
    axios.get('/api/projects/create').then(response => {
      this.users = response.data.users;
      this.mobs = response.data.mobs;
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
    },
    mobIsSelected(mobId) {
      return this.project.mob_id === mobId;
    },
    userIsSelected(userId) {
      return this.project.users.find(user => user.id === userId) !== undefined;
    },
    handleCheck(event) {
      const checkbox = event.toElement;
      const userId = parseInt(checkbox.value);
      const user = this.users.find(user => user.id == userId);

      const checked = checkbox.checked;
      if(checked) {
        this.project.users.push(user);
      } else {
        this.projects.users.filter(user => user.id !== userId)
      }

    },
    sendProject() {
      axios.post('/api/projects', this.project).then(response => {
        this.$router.push({name: 'project', params: {slug: response.data.slug}});
      }).catch(err => {
        console.error(err);
      });
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

  .modal {
    input[type=text] {
      width: 100%;
      box-sizing: border-box;
    }

    .mob-selector {
      .images-container {
        display: flex;
        justify-content: space-between;
        flex-direction: row;

        .image-container {
          flex-basis: 30%;
          padding: 10px;

          &.selected {
            border: 2px solid $cyan;
            border-radius: $borderRadius;
            padding: 8px;
          }

          img {
            max-width: 100%;
            height: auto;
          }
        }

      }
    }

    .modal-user {
      display: flex;
      flex-direction: row;
      align-items: center;
      padding: 10px 0;

      .modal-user-image {
        img {
          max-height: 40px;
          width: auto;
          border-radius: 50%;
        }
      }

      .modal-user-info {
        flex: 1;
      }

    }
  }

}
</style>
