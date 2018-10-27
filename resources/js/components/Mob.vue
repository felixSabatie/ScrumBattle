<template>
    <div class="mob">
        {{mob.name}}
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
          }
      }
  }
</script>

<style scoped>

</style>
