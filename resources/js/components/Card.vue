<template>
  <div class="card">
    <div class="content">
      {{card.name}}
    </div>

    <div class="close">
      <!-- Change with icon -->
      <span @click='onRemoveClicked'>x</span> 
    </div>

    <div class="users">
      <div class="user" v-for="user in card.users"> 
        <img class="user-image" src="https://picsum.photos/20/20" :alt="user.name">
      </div>
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
  margin: 10px;
  position: relative;

  .content {
    color: $textColor;
  }
  .close {
    position: absolute;
    top: 3px;
    right: 3px;
    color: $lightGrey;
    &:hover {
      cursor: pointer;
    }
  }

  .users {
    .user {
      
      .user-image {
        border-radius: 50%;
        height: 20px;
        width: 20px;
      }
    }
  }
}
</style>
