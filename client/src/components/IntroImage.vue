<template>
  <div class="intro-image-container">
    <img src="../assets/img/small_vamp.jpg" />
    <img src="../assets/img/lady_vamp.jpg" />
    <img src="../assets/img/vampire_small.png" />
    <img src="../assets/img/bat.jpg" />
  </div>
</template>

<script>
export default { name: 'IntroImage' };
</script>

<style scoped>
.intro-image-container {
  position: relative;
  height: auto;
  max-width: 400px;
  margin: 0 auto;
  position: relative;
  height: auto;
  max-width: 400px;
  margin: 0 auto;
  height: 300px;
  display: flex;
  justify-content: center;
}

.intro-image-container img {
  position: absolute;
  max-height: 275px;
  animation-name: fadeInOut;
  animation-timing-function: ease-in-out;
  animation-iteration-count: infinite;
  animation-duration: 8s;
}
</style>
