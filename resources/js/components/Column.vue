<template>
  <div class="column" >
    <div class="infos">
      <h1>
        {{column.name}}
      </h1>
    </div>

    <div class="cards">
      <draggable :list=column.cards
                 :options="{group:'columns'}"
                 @end="onDragEnd"
                 :id="`column-${column.id}`"
                 class="cards-container">
        <div  v-for="card in column.cards" :id="`card-${card.id}`">
          <card :card="card" @remove-card="removeCard"
                @remove-user="removeUserFromCard" 
                @add-user="addUserToCard"
          />
        </div>
      </draggable>
    </div>

    <div class="new-card">
      <input type="text"
             placeholder="Add a new card..."
             @keydown.enter="addNewCard"
             @keydown.esc="clearNewCardName"
             v-model="newCardName">
    </div>
  </div>

</template>

<script>
import Card from "./Card";
import draggable from "vuedraggable";
import axios from "../axios-wrapper";
export default {
  name: "Column",
  components: {
    Card,
    draggable
  },
  props: {
    column: {
      type: Object
    }
  },
  data() {
    return {
      newCardName: ""
    };
  },
  methods: {
    clearNewCardName() {
      this.newCardName = "";
    },
    addNewCard() {
      if (this.newCardName !== "") {
        const card = {
          id: 0,
          column_id: this.column.id,
          name: this.newCardName,
          users: [],
          points: 0,
        };
        this.column.cards.push(card);
        
        this.newCardName = "";
        axios.post("/api/cards/", card).then(response => {
          const cardReceived = response.data;
          card.id = cardReceived.id;
          this.$store.commit('projects/newCard', card);
        });
      }
    },
    removeCard(cardToRemove) {
      this.column.cards = this.column.cards.filter(
        card => card.id !== cardToRemove.id
      );
      axios.delete(`/api/cards/${cardToRemove.id}`);
      
      this.$store.commit('projects/removeCard', card);
      cardToRemove.users.forEach(user => {
        const storePayload = {
          user: user,
          amount: cardToRemove.points
        };

        if (this.column.id == 3) {
          //todo Change id with something less breakable
          this.$store.commit("users/removeFromBoth", storePayload);
        } else {
          this.$store.commit("users/removeFromTotal", storePayload);
        }
      });

      if (this.column.id == 3) {
        this.$store.commit("projects/removeFromBoth", cardToRemove.points);
      } else {
        this.$store.commit("projects/removeFromTotal", cardToRemove.points);
      }
    },
    removeUserFromCard(card, user) {
      card.users = card.users.filter(usr => usr.id !== user.id);
      axios.delete(`/api/cards/${card.id}/users/${user.id}`).then(response => {
        //Yeah deleted
      });

      const storePayload = {
        user: user,
        amount: card.points
      };
      if (card.column_id === 3) {
        this.$store.commit("users/removeFromBoth", storePayload);
      } else {
        this.$store.commit("users/removeFromTotal", storePayload);
      }
    },
    addUserToCard(card, user) {
      card.users.push(user);
      axios
        .post(`/api/cards/${card.id}/users`, {
          ...user
        })
        .then(response => {
          //Yeah added
        });

      const storePayload = {
        user: user,
        amount: card.points
      };
      
      this.$store.commit('projects/addUserToCard', {card: card, user: user});

      if (card.column_id == 3) {
        this.$store.commit("users/addToBoth", storePayload);
      } else {
        this.$store.commit("users/addToTotal", storePayload);
      }
    },
    onDragEnd(event) {
      const cardId = this.trim(event.clone.id);
      const fromColumnId = this.trim(event.from.id);
      const toColumnId = this.trim(event.to.id);

      const card = this.$store.state.projects.currentProject.columns.flatMap(col => col.cards)
      .find(card => card.id == cardId || card.id === cardId) ; //Todo use getter of store but i don't understand how to access ti
      console.log(toColumnId);
      axios.put(`/api/cards/${cardId}`, { column_id: toColumnId }).then(response => {
        //Maybe do something if needed
      });

      if (fromColumnId != toColumnId) {
        card.users.forEach(user => {
          const storePayload = {
            user: user,
            amount: card.points,
          }
          if (toColumnId == 3) {
            this.$store.commit("users/addToDone", storePayload);
          } else if (fromColumnId == 3) {
            this.$store.commit("users/removeFromDone", storePayload);
          }
        });
        if (toColumnId == 3) {
          this.$store.commit("projects/addToDone", card.points);
        } else if (fromColumnId == 3) {
          this.$store.commit("projects/removeFromDone", card.points);
        }
      }
    },
    trim(divId) {
      return divId.split("-")[1];
    }
  }
};
</script>

<style lang="scss">
@import "../../sass/app";
.column {
  width: 300px;
  border-radius: $borderRadius;
  background: $columns;
  padding: 5px;
  display: flex;
  flex-direction: column;
  min-height: 130px;
  max-height: 100%;
  box-sizing: border-box;

  .infos {
    display: inline-block;
    text-align: center;
    width: 100%;

    h1 {
      font-size: 16px;
      font-weight: 600;
      text-align: center;
      width: 100%;
    }
  }

  .cards {
    padding: 10px;
    flex: 1;
    display: flex;
    overflow: auto;

    .cards-container {
      flex: 1;
    }
  }

  .new-card {
    padding: 10px;

    input {
      width: 100%;
      border-style: none;
      padding: 5px;

      border-radius: $borderRadius;
      outline-width: 0;
      box-sizing: border-box;

      &:focus {
        box-shadow: 0 0 1px 1px $accentColor;
      }
    }
  }

  //Placeholder for draggable
  .sortable-ghost {
    opacity: 0.6;
  }

  //Moving item
  .sortable-chosen {
    //background: red;
  }
}
</style>
