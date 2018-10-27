<template>
    <div class="mob">
        <img class="mob-image" :src="mob.image">
    </div>
</template>

<script>
  export default {
    name: "Mob",
      data() {
          return {
            mob : {},
          }
      },
      mounted(){
        // TODO: Axios call (axios.get)
          this.mob = {
              name: "Mob",
              image: '/assets/boss.png'
          }
      },
  }
</script>


<style lang="scss">
    @import "../../sass/app";
    .mob {
        height: 100px;
        position: absolute;
        bottom: 10%;
        right: 10%;
    }
    .mob-image {
        height: 100%;
    }
</style>
