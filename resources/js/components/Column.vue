<template>
    <div class="column">
        <div v-for="card in column.cards">
            <card :card="card"/>
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
  }
};
</script>

<style scoped>
</style>
