<template>
  <div class="card" @click="openModal">
    <div class="content">
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
        <div v-for="user in card.users" class="modal-users">
          <div class="modal-users-info">
            {{user.name}}
          </div>
         
        </div>
      </div>  
    </modal>
    
  </div>
</template>

<script>
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
  methods: {
    onRemoveClicked() {
      this.$emit("remove-card", this.card);
    },
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
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
