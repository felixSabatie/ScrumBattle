<template>
    <div class="mob hurt">
        <!--TODO : add hurt on action-->
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


    .hurt{
        animation: hurt linear 0.2s;
        animation-iteration-count: 10;
    }

    @keyframes hurt{
        0% {
            transform:  translate(0%,0%)  scaleX(1.00) ;
        }
        50% {
            transform:  translate(2%,-2%)  scaleX(0.9) ;
            filter: opacity(25%);
        }
        100% {
            transform:  translate(0%,0%)  scaleX(1.00) ;
        }
    }
</style>
