<template>
  <div class="columns">
    <div v-for="column in columns">
      <column :column="column"/>
    </div>
  </div>
</template>

<script>
import Column from "./Column";
export default {
  name: "Columns",
  components: {
    Column
  },
  data() {
    return { 
        columns: [],
    }
  },
  mounted() {
      this.columns = [ //TODO : change with backend call
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
        }, 
        {
          name: "Second column",
          cards: [
            {
              name: "First Card"
            },
            {
              name: "Second Card"
            }
          ]
        }
      ];
    }
};
</script>

<style scoped>
</style>
