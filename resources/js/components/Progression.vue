<template>
    <div class="progression" :style="{height: height}">
        <div class="progress-wrapper">
            <div class="progress" ref="progress"></div>
            <img class="user_icon" ref="user_icon" :src="user.avatar"/>
        </div>
    </div>
</template>

<script>
export default {
  name: "Progression",
  props: ["user", "height"],
  data() {
    return {
      percent: 0,
      oldPercent: 0
    };
  },
  mounted() {
    this.calculatePerc();
    this.move();
  },

  computed: {},
  watch: {
    user() {
      this.calculatePerc();
    },
    percent(val, oldVal) {
      this.oldPercent = oldVal;
      this.move();
    }
  },
  methods: {
    calculatePerc() {
      this.percent =
        this.user.total_points !== 0
          ? (this.user.done_points / this.user.total_points) * 100
          : 0;
    },
    move() {
      const elem = this.$refs.progress;
      const icon = this.$refs.user_icon;
      let width = this.oldPercent;

      const id = setInterval(
        (percent, oldPercent) => {
          let stop = oldPercent > percent ? width <= percent : width >= percent;

          if (stop) {
            clearInterval(id);
          } else {
            oldPercent > percent ? width-- : width++;
            elem.style.width = width + "%";
            icon.style.left = width + "%";
          }
        },
        10,
        this.percent,
        this.oldPercent
      );
    }
  }
};
</script>

<style lang=scss>
.progression {
  width: 80%;
  position: relative;
}
.progress-wrapper {
  width: 100%;
  height: 100%;
  position: absolute;
}

.progress {
  width: 1%;
  height: 100%;
  background-color: #2abb9b;
  position: absolute;
}

.progress-wrapper img {
  display: block;
  position: absolute;
  top: 50%;
  left: 1%;
  max-height: 100%;
  max-width: 100%;
  transform: translate(-50%, -50%);
}
</style>
