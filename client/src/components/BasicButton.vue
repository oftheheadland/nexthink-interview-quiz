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
  font-size: 20px;
  padding: 0.6rem;
  padding-bottom: 0.4rem;
}

.basic-button:hover {
  background-color: var(--primary-blue-green);
  color: var(--primary-black);
  transform: translateY(3px);
}

.basic-button:focus {
  background-color: var(--primary-blue-green);
  color: var(--primary-black);
  transform: translateY(3px);
}
</style>
