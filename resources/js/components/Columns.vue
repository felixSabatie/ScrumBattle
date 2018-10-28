<template>
  <div class="columns" :class="containerClass">
    <column v-for="column in columns" :column="column" :key="column.id" :doneColumnId="doneColumnId"/>
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
  props: ['project'],
  data() {
    return {
      columns: []
    };
  },
 computed: {
   doneColumnId() {
     return this.columns.find(column => column.name === 'done').id;
   },
   containerClass() {
     if(this.project == undefined)
       return '';
     else return 'project-container-' + (this.project.id % 3 + 1).toString();
   },
   ...mapState({
    projectColumns: state => state.projects.currentProject.columns,
  }),
 },
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
  padding: 10px;
  box-sizing: border-box;

  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;

  &.project-container-1 {
    background-color: #3A3A26;
  }
  &.project-container-2 {
    background-color: #F1C87E;
  }
  &.project-container-3 {
    background-color: #D3EFFC;
  }
}

</style>
