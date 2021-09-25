<template>
  <div>
    <div v-if="quizServiceLoading">Loading...</div>

    <div v-if="quizServiceFailure">
      Unable to contact WordPress API. Please refresh your browser tab.
    </div>

    <transition name="fade">
      <div v-if="quizServiceReady && !quizStarted">
        <h1>What kind of vampire are you?</h1>
        <p>
          The Halloween season is almost upon us! Which vampire will you be this
          year? Try not to get spooked!
        </p>
        <div>
          <StartButton text="Click Here..." @click="quizStarted = true" />
        </div>
      </div>
    </transition>

    <div v-if="quizStarted">
      <div v-if="!quizCompleted">
        <h2>
          {{ quizQuestionsFormatted[currentQuestionIndex].question_text }}
        </h2>

        <QuizImage
          :src="quizQuestionsFormatted[currentQuestionIndex].image.url"
        />

        <div class="choice-container">
          <label class="dark-label">
            <input
              type="radio"
              v-model="selectedAnswer"
              :value="quizQuestionsFormatted[currentQuestionIndex].a_weight"
            />
            <span>{{ quizQuestionsFormatted[currentQuestionIndex].a }}</span>
          </label>

          <label class="dark-label">
            <input
              type="radio"
              v-model="selectedAnswer"
              :value="quizQuestionsFormatted[currentQuestionIndex].b_weight"
            />
            <span>{{ quizQuestionsFormatted[currentQuestionIndex].b }}</span>
          </label>

          <label class="dark-label">
            <input
              type="radio"
              v-model="selectedAnswer"
              :value="quizQuestionsFormatted[currentQuestionIndex].c_weight"
            />
            <span>{{ quizQuestionsFormatted[currentQuestionIndex].c }}</span>
          </label>

          <label class="dark-label">
            <input
              type="radio"
              v-model="selectedAnswer"
              :value="quizQuestionsFormatted[currentQuestionIndex].d_weight"
            />
            <span>{{ quizQuestionsFormatted[currentQuestionIndex].d }}</span>
          </label>
        </div>

        <div v-if="selectedAnswer" class="next-button-container">
          <BasicButton
            text="Next Question"
            @click="handleNextQuestion"
          ></BasicButton>
        </div>
      </div>

      <transition name="slide-fade">
        <div v-if="quizCompleted">
          <QuizCompletionScreen :character="selectedCharacter" />
          <BasicButton text="Play Again?" @click="handleRestart" />
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import QuizImage from './QuizImage.vue';
import StartButton from './StartButton.vue';
import BasicButton from './BasicButton.vue';
import QuizCompletionScreen from './QuizCompletionScreen.vue';

export default {
  name: 'Quiz',
  components: { QuizImage, StartButton, BasicButton, QuizCompletionScreen },
  created: function() {
    this.fetchData();
  },
  data: function() {
    return {
      selectedAnswer: null,
      answerWeights: {},
      questions: { status: 'fetching', data: null },
      characters: { status: 'fetching', data: null },
      currentQuestionIndex: 0,
      quizStarted: false,
      quizCompleted: false,
    };
  },
  computed: {
    // if all services have resolved and data is populated - quiz is ready to start
    quizServiceReady: function() {
      return (
        this.questions.status === 'success' &&
        this.questions.data !== null &&
        this.characters.status === 'success' &&
        this.characters.data !== null
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

    quizQuestionsFormatted: function() {
      if (!this.quizServiceReady) return [];
      const questionKeys = Object.keys(this.questions.data);
      const formattedQuestions = questionKeys.map(
        key => this.questions.data[key],
      );
      return formattedQuestions;
    },

    selectedCharacter: function() {
      if (!this.quizCompleted) return null;

      // if there is a tie - the most recent weight added to the answerWeights object is selected as a tie-breaker
      const highestWeight = Object.keys(this.answerWeights).reduce((a, b) =>
        this.answerWeights[a] > this.answerWeights[b] ? a : b,
      );

      const matchedCharacter = this.characters.data.find(obj => {
        return obj.character_weight === highestWeight;
      });

      return matchedCharacter;
    },
  },
  methods: {
    fetchData: function() {
      const apiUrl =
        window.location.hostname === 'localhost'
          ? 'http://nexthink-quiz-interview.local/wp-json/api'
          : 'https://nexhalloween2.flywheelsites.com/wp-json/api/';

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
    handleNextQuestion: function() {
      typeof this.answerWeights[this.selectedAnswer] === 'undefined'
        ? (this.answerWeights[this.selectedAnswer] = 1)
        : this.answerWeights[this.selectedAnswer]++;

      this.selectedAnswer = null;

      if (
        this.currentQuestionIndex ===
        this.quizQuestionsFormatted.length - 1
      ) {
        this.quizCompleted = true;
        return;
      }

      this.currentQuestionIndex++;
    },
    handleRestart: function() {
      window.location.reload();

      // TODO: reset state values instead of reloading the page
      //   this.currentQuestionIndex = 0;
      //   this.answerWeights = {};
      //   this.quizCompleted = false;
    },
  },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.slide-fade-enter-active {
  transition: all 0.7s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}

.dark-label {
  border: 2px solid #d81639;
  padding: 2px 4px 2px 2px;
  border-radius: 3px;
  margin: 5px;
  cursor: pointer;
  max-width: 200px;
  flex-basis: 50%;
}

.dark-label:hover {
  background-color: #d8163929;
}

.dark-label input {
  cursor: pointer;
}

.next-button-container {
  margin-top: 2.5rem;
}

.choice-container {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}

@media only screen and (max-width: 600px) {
  .dark-label {
    flex-basis: 100%;
  }
}
</style>
