<template>
  <button class="start-button">
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
.start-button {
  background-color: var(--primary-black);
  border: 2px solid var(--primary-red);
  border-radius: 9px;
  color: var(--primary-red);
}

.start-button:hover span {
  display: none;
}

.start-button:hover:before {
  content: '...If you dare!';
}
.start-button:hover {
  background-color: var(--primary-red);
  color: var(--primary-black);
}
</style>
