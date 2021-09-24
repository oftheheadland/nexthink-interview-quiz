<template>
    <Quiz />
</template>

<script>
import Quiz from './components/Quiz.vue';
require('@/assets/styles/main.css');
require('@/assets/styles/variables.css');

export default {
  name: 'App',
  components: {
    Quiz,
  },
};
</script>
