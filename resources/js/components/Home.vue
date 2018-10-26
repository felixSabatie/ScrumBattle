<template>
  <div class="home">
    <div v-for="column in columns">
      <column :column="column"/>
    </div>
  </div>
</template>

<script>
import Column from "./Column";
export default {
  name: "Home",
  components: {
    Column
  },
  data() {
    return { 
      columns: [ //TODO : change with backend call
        {
          name: "First column",
          cards: [
            {
              name: "First Card"
            },
            {
              name: "Second Card"
            }
          ]
        }
      ]
    };
  }
};
</script>

<style scoped>
</style>
