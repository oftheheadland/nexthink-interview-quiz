<template>
  <button class="basic-button">
    <span>{{ text }}</span>
  </button>
</template>

<script>
export default {
  name: 'StartButton',
  props: {
    text: String.required,
  },
};
</script>

<style scoped>
.basic-button {
  background-color: var(--primary-black);
  border: 2px solid var(--primary-blue-green);
  color: var(--primary-blue-green);
}

.basic-button:hover {
  background-color: var(--primary-blue-green);
  color: var(--primary-black);
}
</style>
