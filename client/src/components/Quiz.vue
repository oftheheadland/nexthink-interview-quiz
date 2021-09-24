<template>
  <p>Quiz Here</p>
</template>

<script>
export default {
  name: 'Quiz',
  created: function() {
    this.fetchData();
  },
  data: function() {
    return {
      message: '',
      userName: 'Andrew',
      answerWeights: null,
      questions: null,
      characters: null,
      currentQuestionIndex: 0,
    };
  },
  methods: {
    fetchData: function() {
      const apiUrl = 'http://nexthink-quiz-interview.local/wp-json/api';
      fetch(`${apiUrl}/get_questions`)
        .then(resp => resp.json())
        .then(json => (this.questions = json));

          fetch(`${apiUrl}/get_characters`)
        .then(resp => resp.json())
        .then(json => (this.characters = json));

    
    },
  },
};
</script>

<style scoped></style>
