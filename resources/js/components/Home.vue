<template>
  <div class="home">
    <columns/>
    <progression/>
  </div>
</template>

<script>
import Columns from "./Columns";
import Progression from "./Progression";
export default {
  name: "Home",
  components: {
      Progression,
    Columns
  },
  data() {
    return {

    }
  }
}
</script>

<style scoped>
</style>
