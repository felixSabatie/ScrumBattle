<template>
    <div class="progressions">
        <progression v-for='user in myUsers' :user='user' :height='height' :key="user.id"/>
        
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
      height: 0,
      myUsers: []
    };
  },
  computed: {
    ...mapState({
      users: state => state.users.users
    })
  },
  methods: {
      copyUsers() {
         //VEEEERY UGLY WORKOROUND BUT FUCK IT IT WORKS 
        this.$nextTick(() => {
          this.myUsers = JSON.parse(JSON.stringify(this.users));
        });
      }
  },
  watch: {
    users: {
      handler() {
          console.log('catched');
          this.copyUsers();
      },
      deep: true
    }
  },
  mounted() {
    this.goal_img = "/images/goal_flag.png";
    this.height = 100 / this.users.length + "%";
    this.copyUsers();
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
