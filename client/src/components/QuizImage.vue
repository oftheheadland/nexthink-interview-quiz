<template>
  <div class="quiz-image-container">
    <img :src="src" />
  </div>
</template>

<script>
export default {
  props: {
    src: String.required,
  },
};
</script>

<style scoped>
.quiz-image-container {
  margin-bottom: 1rem;
}
.quiz-image-container img {
  max-width: 750px;
  width: 80%;
}

@media only screen and (max-width: 600px) {
  .quiz-image-container img {
    width: 100%;
  }
}
</style>
