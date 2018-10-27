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

<style lang='scss'>
@import "../../sass/app";
.card {
  background: $card;
  border-radius: $borderRadius;
  color: $textColor;
  padding: 10px;
  margin: 10px;
}
</style>
