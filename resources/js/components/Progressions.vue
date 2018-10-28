<template>
    <div class="progressions">
        <progression v-for='user in users' :user='user' :height='height' :key="user.id"/>
        
        <div class="goal_wrapper">
            <img :src="goal_img"/>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
import Progression from "./Progression";
export default {
  name: "Progressions",
  components: {
    Progression
  },
  data() {
    return {
      goal_img: "",
      height: 0
    };
  },
  computed: {
    ...mapState({
      users: state => state.users.users
    })
  },
  watch: {
    users: {
      handler() {
        console.log("watch set in parent");
       
        this.$forceUpdate();
      },
      deep: true
    }
  },
  mounted() {
    this.goal_img = "/images/goal_flag.png";
    this.height = 100 / this.users.length + "%";
  }
};
</script>

<style scoped>
.progressions {
  height: 100%;
  width: 100%;
  background-color: #a0ebef;
  position: relative;
}
.goal_wrapper {
  position: absolute;
  width: 20%;
  height: 100%;
  right: 0%;
  top: 0%;
}
.goal_wrapper img {
  position: absolute;
  max-height: 100%;
  max-width: 100%;
  display: inline-block;
  left: 20%;
}
</style>
