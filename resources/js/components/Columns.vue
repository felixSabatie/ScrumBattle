<template>
  <div class="columns">
    <column v-for="column in columns" :column="column" :key="column.id"/>
  </div>
</template>

<script>
import Column from "./Column";
export default {
  name: "Columns",
  components: {
    Column
  },
  // props: ['columns'],
  data() {
    return {
      columns: []
    };
  },
  mounted() {
    this.columns = [{
        id: 1,
        name: "First column",
        group: "test",
        cards: [
          {
            id: 1,
            name: "First Card"
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

<style lang="scss">

.columns {
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  align-items: flex-start;
  height: 100%;
  padding: 10px;
  box-sizing: border-box;
}

</style>
