<template>
  <div class="card">
      {{card.name}}
  </div>
</template>

<script>
  export default {
    name: "Card",
     props: {
      card: {
        type: Object,
      }
    },
    data() {
      return {
        
      }
    },
  }
</script>

<style scoped>

</style>
