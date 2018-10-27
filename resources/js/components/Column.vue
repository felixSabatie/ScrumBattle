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
                 class="cards-container"
                 >
        <div v-for="card in column.cards" :id="`card-${card.id}`">
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
import axios from '../axios-wrapper';
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
      const card = {
        column_id: this.column.id,
        name: this.newCardName,
        users: [],
      };
      this.column.cards.push(card);
      this.newCardName = "";
      axios.post('/api/cards/', card).then((response) => {
        const id = response.data.id;
        card.id = id;
      });
    },
    removeCard(cardToRemove) {
      this.column.cards = this.column.cards.filter(
        card => card.id !== cardToRemove.id
      );
      axios.delete(`/api/cards/${cardToRemove.id}`);
    },
    removeUserFromCard(card, user) {
      card.users = card.users.filter(usr => usr.id !== user.id);
    },
    addUserToCard(card, user) {
      card.users.push(user);
    },
    onDragEnd(event) {
      const cardId = this.trim(event.clone.id);
      const fromColumnId = this.trim(event.from.id); //Not useful right now but if we ever need it, this is how you access it
      const toColumnId = this.trim(event.to.id);

      axios.put(`/api/cards/${cardId}`, {column_id: toColumnId})
      .then(response => {
        //Maybe do something if needed
      })
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
