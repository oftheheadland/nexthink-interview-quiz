<template>
  <div>
    <h3>
      You are {{ character.character_name }} from
      {{ character.character_source }}!
    </h3>
    <img :src="character.character_image.url" />

    <div class="quote-container ">
      <p class="italic">"{{ character.character_quote }}"</p>
    </div>

    <div class="description-container">
      <p>{{ character.character_description }}</p>
    </div>
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
  max-width: 600px;
  width: 80%;
  height: auto;
}

.quote-container {
  max-width: 450px;
  margin: auto;
  color: var(--primary-white);
}

.description-container {
  max-width: 600px;
  margin: auto;
  color: var(--primary-white);
}

.italic {
  font-style: italic;
}
</style>
