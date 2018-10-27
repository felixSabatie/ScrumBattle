<template>
  <div class="card" >
    <div class="content" @click="openModal">
      {{card.name}}
    </div>

    <div class="close">
      <!-- Change with icon -->
      <span @click='onRemoveClicked'>x</span>
    </div>

    <div class="users">
      <div class="user" v-for="user in card.users"> 
        <img class="user-image" :src="user.avatar" :alt="user.name">
      </div>
    </div>

    <modal v-if="showModal" @close="closeModal">
      <div slot="header">
        <h1>{{card.name}}</h1>
      </div>

      <div slot="body">
        <div v-for="user in users" class="modal-users">
          <div class="modal-users-info">
            {{user.name}}
          </div>
          <div class="modal-users-check">
            <input type="checkbox" :checked="isInCard(user)" :value="user.id" @click="handleCheck">
          </div>
         
        </div>
      </div>  
    </modal>
    
  </div>
</template>

<script>
import { mapState } from 'vuex'
import Modal from "./Modal";

export default {
  name: "Card",
  components: {
    Modal
  },
  props: {
    card: {
      type: Object
    }
  },
  data() {
    return {
      showModal: false,
      toRemove: [],
    }
  },
  computed: mapState({
    users: state => state.projects.currentProject.users
  }),
  methods: {
    onRemoveClicked() {
      this.$emit("remove-card", this.card);
      
    },
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    handleCheck(event) {
      const checkbox = event.toElement;
      const userId = checkbox.value;
      const user = this.users.find(user => user.id == userId);
    
      const checked = checkbox.checked;
      if(checked) {
        this.$emit('add-user', this.card, user);
      } else {
        this.$emit('remove-user', this.card, user);
      }
      
    },
    isInCard(user) {
      return this.card.users.filter(usr => user.id === usr.id)
                            .length > 0;
    }
  }
};
</script>

<style lang='scss'>
@import "../../sass/app";
.card {
  background: $card;
  border-radius: $borderRadius;
  padding: 10px;
  margin: 10px 0;
  position: relative;

  .content {
    color: $textColor;
  }
  .close {
    position: absolute;
    top: 3px;
    right: 5px;
    color: $lightGrey;
    &:hover {
      cursor: pointer;
    }
  }

  .users {
    .user {
      .user-image {
        border-radius: 50%;
        height: 20px;
        width: 20px;
      }
    }
  }

  .modal-header {
    h1 {
      font-size: 18px;
    }
  }
}
</style>
