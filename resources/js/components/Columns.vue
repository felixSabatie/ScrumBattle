<template>
  <div class="columns">
    <column v-for="column in columns" :column="column" :key="column.id"/>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import axios from '../axios-wrapper';
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
   computed: mapState({
    projectColumns: state => state.projects.currentProject.columns,
  }),
  mounted() {
    this.columns = JSON.parse(JSON.stringify(this.projectColumns))
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
