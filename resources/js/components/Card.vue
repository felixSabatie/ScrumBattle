<template>
  <div class="card">
    <div class="content">
      {{card.name}}
    </div>

    <div class="close">
      <!-- Change with icon -->
      <span @click='onRemoveClicked'>x</span>
    </div>

  </div>
</template>

<script>
export default {
  name: "Card",
  props: {
    card: {
      type: Object
    }
  },
  methods: {
    onRemoveClicked() {
      this.$emit('remove-card', this.card);
    }
  }
};
</script>

<style lang='scss'>
@import "../../sass/app";
.card {
  background: $card;
  border-radius: $borderRadius;
  padding: 10px;
  margin: 10px 0;
  position: relative;

  .content {
    color: $textColor;
  }
  .close {
    position: absolute;
    top: 3px;
    right: 5px;
    color: $lightGrey;
    &:hover {
      cursor: pointer;
    }
  }
}
</style>
