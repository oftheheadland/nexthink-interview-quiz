<template>
  <div>
    <div v-if="quizServiceLoading">Loading...</div>
    <div v-if="quizServiceFailure">Failed to fetch...</div>
    <div v-if="quizServiceReady">Ready!</div>
    <p>Quiz Here</p>
  </div>
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
      questions: { status: 'fetching', data: null },
      characters: { status: 'fetching', data: null },
      currentQuestionIndex: 0,
    };
  },
  computed: {
    // if all services have resolved and data is populated - quiz is ready to start
    quizServiceReady: function() {
      return (
        this.questions.status === 'success' &&
        this.questions.data &&
        this.characters.status === 'success' &&
        this.characters.data
      );
    },

    quizServiceLoading: function() {
      return (
        this.questions.status === 'fetching' &&
        this.characters.status === 'fetching'
      );
    },

    quizServiceFailure: function() {
      return (
        this.questions.status === 'failure' ||
        this.characters.status === 'failure'
      );
    },
  },
  methods: {
    fetchData: function() {
      const apiUrl =
        window.location.hostname === 'localhost'
          ? 'http://nexthink-quiz-interview.local/wp-json/api'
          : 'PRODUCTION_WP_URL';

      // fetch and store questions
      fetch(`${apiUrl}/get_questions`)
        .then(resp => resp.json())
        .then(json => {
          console.log(json);
          this.questions = { status: 'success', data: json };
        })
        .catch(err => {
          console.error(err);
          this.questions = { status: 'failure', data: null };
        });

      // fetch and store characters
      fetch(`${apiUrl}/get_characters`)
        .then(resp => resp.json())
        .then(json => {
          console.log('characters', json);
          this.characters = { status: 'success', data: json };
        })
        .catch(err => {
          console.error(err);
          this.characters = { status: 'failure', data: null };
        });
    },
  },
};
</script>

<style scoped></style>
