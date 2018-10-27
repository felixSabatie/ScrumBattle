<template>
  <div class="home">
    <columns/>
    <progression/>
    <Game></Game>
  </div>
</template>

<script>
import Columns from "./Columns";
import Progression from "./Progression";
import Game from "./Game";
export default {
  name: "Home",
  components: {
      Progression,
      Columns,
      Game
  },
  data() {
    return {
    };
  }
}
</script>

<style lang="scss">
    @import "../../sass/app";
</style>
