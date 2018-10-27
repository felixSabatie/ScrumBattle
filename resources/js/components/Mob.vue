<template>
    <div class="mob">
        {{mob.name}}
        <img class="mob" :src="mob.image">
    </div>
</template>

<script>
  export default {
    name: "Mob",
      props: {
          mob: {
              type: Object,
          }
      },
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
        height: 30%;
        width: 30%;
        position: absolute;
    }
</style>
