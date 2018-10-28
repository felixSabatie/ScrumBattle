<template>
  <div class="card" >
    <div class="card-wrapper" @click="openModal">
      <div class="content" >
        {{card.name}}
      </div>

    <div class="points selected" v-if="card.points">
      <span>{{card.points}}</span>
    </div>

      <div class="users">
        <div class="user" v-for="user in card.users">
          <img class="user-image" :src="user.avatar" :alt="user.name">
        </div>
      </div>
    </div>

    <modal v-if="showModal" @close="closeModal" class="modal">
      <div slot="header">
        <h1>{{card.name}}</h1>
        <div class="points-list">
          <div class="points" v-for="point in pointList"
               @click.stop='selectPoint(point)'
               :class='isSelectedPoint(point)'>
            {{point}}
          </div>
        </div>
      </div>

      <div slot="body">
        <div class="users">
          <div v-for="user in users" class="modal-user">
            <div class="modal-user-image">
              <img :src="user.avatar" alt="user avatar">
            </div>
            <div class="modal-user-info">
              {{user.name}}
            </div>
            <div class="modal-user-check">
              <input type="checkbox" :checked="isInCard(user)" :value="user.id" @click="handleCheck">
            </div>
          </div>
        </div>
      </div>
    </modal>

     <div class="close">
      <!-- Change with icon -->
      <span @click.stop='onRemoveClicked'>x</span>
    </div>
  </div>
</template>

<script>
import axios from '../axios-wrapper';
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
      pointList: [1,2,3,5,8,13,21],
      selectedPoint: 0,
    }
  },
  computed: mapState({
    users: state => state.projects.currentProject.users
  }),
  methods: {
    selectPoint(points) {
      this.card.points = points;
      axios.put(`/api/cards/${this.card.id}`, {
        ...this.card,
      })
      .then((response) => {
        //Yeah
      })
    },
    isSelectedPoint(points) {
      return this.card.points === points ? "selected" : "";
    },
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

  .points {
    display: block;
    width: 23px;
    height: 23px;
    font-size: 13px;
    background-color: $lightGrey;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;

    &.selected {
      background: $primaryColor;
      color: white;
    }
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
      display:inline-block;
      padding: 5px;
      .user-image {
        border-radius: 50%;
        height: 20px;
        width: 20px;
      }
    }
  }

  .modal {
    .modal-header {
      h1 {
        font-size: 18px;
      }

      .points-list {
        display: flex;
        justify-content: space-evenly;
      }
    }

    .users {

      .modal-user {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 10px 0;

        .modal-user-image {
          width: 40px;
          height: 40px;
          text-align: center;
          img {
            max-height: 100%;
            max-width: 100%;
            border-radius: 50%;
          }
        }

        .modal-user-info {
          flex: 1;
        }
        .modal-user-check {
          transform: scale(1.3);
        }
      }
    }

  }
}
</style>
