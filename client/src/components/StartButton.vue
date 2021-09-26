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
  border: 3px solid var(--primary-red);
  border-radius: 9px;
  color: var(--primary-red);
  transition: background-color 0.5s ease;
  font-size: 20px;
  padding: 0.6rem;
  padding-bottom: 0.4rem;
}

.start-button:hover span,
.start-button:focus span {
  display: none;
}

.start-button:hover:before,
.start-button:focus:before {
  content: '...If you dare!';
}

.start-button:hover {
  background-color: var(--primary-red);
  color: var(--primary-black);
}

.start-button:focus {
  background-color: var(--primary-red);
  color: var(--primary-black);
}
</style>
