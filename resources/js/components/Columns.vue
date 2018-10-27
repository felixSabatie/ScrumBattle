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
      columns: []
    };
  },
  mounted() {
    this.columns = [
      //TODO : change with backend call
      {
        id: 1,
        name: "First column",
        group: "test",
        cards: [
          {
            id: '1',
            name: "First Card",
            users: [
              {
                name: 'Jonhy boy',
              }
            ]
          },
          {
            id: 2,
            name: "Second Card"
          }
        ]
      },
      {
        id: 2,
        name: "Second column",
        group: "test",
        cards: [
          {
            id: 3,
            name: "First Card"
          },
          {
            id: 4,
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
