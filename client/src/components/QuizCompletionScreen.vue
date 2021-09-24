<template>
  <div>
    <img :src="character.character_image.url" />
    <p>
      You are <strong>{{ character.character_name }}</strong
      >!
    </p>
    <p>{{ character.character_description }}</p>
  </div>
</template>

<script>
export default {
  props: {
    character: Object.required,
  },
};
</script>

<style scoped>
img {
  max-width: 750px;
  width: 80%;
}
</style>
