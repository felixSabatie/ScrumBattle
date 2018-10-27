<template>
    <div class="column">
      <div class="infos">
        <h1>
          {{column.name}}
        </h1>
      </div>

        <div class="cards">
            <div v-for="card in column.cards">
              <card :card="card" v-on:remove-card="removeCard"/>
            </div> 
        </div>

        <div class="new-card">
          <input type="text" 
                 placeholder="Add a new card..."
                 v-on:keydown.enter="addNewCard"
                 v-model="newCardName"
                 >
        </div>
    </div>
    
</template>

<script>
import Card from "./Card";
export default {
  name: "Column",
  components: {
    Card
  },
  props: {
    column: {
      type: Object
    }
  },
  data() {
    return {
      newCardName: ''
    }
   
  },
  methods: {
    addNewCard() {
      //todo add card to backend

      this.column.cards.push({
        id: (this.column.cards[this.column.cards.length-1] || 0) +1 , //todo change id with the one gotten from backend
        name: this.newCardName,
      });
      this.newCardName = '';
    },
    removeCard(cardToRemove) {
     this.column.cards = this.column.cards.filter((card) => card.id !== cardToRemove.id);
     //todo remove card from backend
    }
  }
};
</script>

<style lang="scss">
@import "../../sass/app";
.column {
  width: 150px;
  border-radius: $borderRadius;
  background: $columns;
  padding: 5px;
  margin: 5px;
  //todo center properly
  .infos {
    display: inline-block;
    text-align: center;

    h1 {
      font-size: 16px;
      font-weight: 600;
      text-align: center;
    }
  }
  .cards {
    margin: 5px;
  }

  .new-card {
    margin: 5px;
    input {
      border-style: none;
      padding: 5px;

      border-radius: 7px;
      outline-width: 0;

      &:focus {
        box-shadow: 0 0 1px 1px $accentColor;
      }
    }
  }
}
</style>
