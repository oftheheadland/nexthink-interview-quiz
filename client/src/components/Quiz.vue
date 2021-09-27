<template>
  <div>
    <div v-if="quizServiceLoading">
      <h1>Loading...</h1>
    </div>

    <div v-if="quizServiceFailure">
      <h1>Unable to contact WordPress API. Please refresh your browser tab.</h1>
    </div>

    <transition name="fade">
      <div v-if="quizServiceReady && !quizStarted">
        <h1>Which famous vampire are you?</h1>
        <p class="orange-text">
          The Halloween season is almost upon us! Which vampire will you be this
          year? Try not to get spooked!
        </p>

        <IntroImage />

        <div>
          <StartButton text="Click Here..." @click="handleQuizStart" />
        </div>
      </div>
    </transition>

    <div v-if="quizStarted">
      <transition name="fade">
        <div v-if="!quizCompleted && quizCurrentlyActive">
          <h2>
            {{ quizQuestionsFormatted[currentQuestionIndex].question_text }}
          </h2>

          <QuizImage
            :src="quizQuestionsFormatted[currentQuestionIndex].image.url"
          />

          <div class="choice-container">
            <input
              type="radio"
              v-model="selectedAnswer"
              :value="quizQuestionsFormatted[currentQuestionIndex].a_weight"
              id="choiceA"
              name="ChoiceA"
              class="hidden-input"
              tabindex="1"
            />
            <label class="dark-label" for="choiceA">
              <span>{{ quizQuestionsFormatted[currentQuestionIndex].a }}</span>
            </label>

            <input
              type="radio"
              v-model="selectedAnswer"
              :value="quizQuestionsFormatted[currentQuestionIndex].b_weight"
              id="choiceB"
              name="choiceB"
              class="hidden-input"
              tabindex="2"
            />
            <label class="dark-label" for="choiceB">
              <span>{{ quizQuestionsFormatted[currentQuestionIndex].b }}</span>
            </label>

            <input
              type="radio"
              v-model="selectedAnswer"
              :value="quizQuestionsFormatted[currentQuestionIndex].c_weight"
              id="choiceC"
              name="choiceC"
              class="hidden-input"
              tabindex="3"
            />
            <label class="dark-label" for="choiceC">
              <span>{{ quizQuestionsFormatted[currentQuestionIndex].c }}</span>
            </label>

            <input
              type="radio"
              v-model="selectedAnswer"
              :value="quizQuestionsFormatted[currentQuestionIndex].d_weight"
              id="choiceD"
              name="choiceD"
              class="hidden-input"
              tabindex="4"
            />
            <label class="dark-label" for="choiceD">
              <span>{{ quizQuestionsFormatted[currentQuestionIndex].d }}</span>
            </label>
          </div>

          <div v-if="selectedAnswer" class="next-button-container">
            <BasicButton
              :text="nextButtonText"
              @click="handleNextQuestion"
            ></BasicButton>
          </div>
        </div>
      </transition>

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
import IntroImage from './IntroImage.vue';

export default {
  name: 'Quiz',
  components: {
    QuizImage,
    StartButton,
    BasicButton,
    QuizCompletionScreen,
    IntroImage,
  },
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
      quizCurrentlyActive: false, // used to fade the quiz in and out
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

    // convert questions data from an object with a property for each question to an array of invdividual question objects
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
    nextButtonText: function() {
      if (this.currentQuestionIndex === this.quizQuestionsFormatted.length - 1)
        return 'Get Results';
      return 'Next Question';
    },
  },
  methods: {
    fetchData: function() {
      const apiUrl =
        window.location.hostname === 'localhost'
          ? 'http://flywheel-nexthink-interview-site.local/wp-json/api'
          : 'https://nexhalloween2.flywheelsites.com/wp-json/api';

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
      this.quizCurrentlyActive = false;

      if (
        this.currentQuestionIndex ===
        this.quizQuestionsFormatted.length - 1
      ) {
        // timeout to let quiz fade out animation finish before fading in completion screen
        setTimeout(() => {
          this.quizCompleted = true;
        }, 500);
        return;
      }

      setTimeout(() => {
        this.quizCurrentlyActive = true;
      }, 500);

      this.currentQuestionIndex++;
    },
    handleQuizStart: function() {
      this.quizStarted = true;
      // timeoout to let quiz intro fade out completely before displaying quiz
      setTimeout(() => {
        this.quizCurrentlyActive = true;
      }, 500);
    },
    handleRestart: function() {
      window.location.reload();
    },
  },
};
</script>

<style scoped>
/* completely hide inputs - but don't set to 'display: none' which prevents tab key interaction */
.hidden-input {
  opacity: 0;
  position: absolute;
  z-index: -1;
}

.dark-label {
  border: 2px solid var(--primary-red);
  border-radius: 3px;
  margin: 5px;
  cursor: pointer;
  max-width: 200px;
  flex-basis: 50%;
  display: flex;
  justify-content: center;
  transition: background-color 0.65s ease;
  padding: 0.75rem;
}

.dark-label span {
  margin: auto;
}

.dark-label:hover {
  background-color: var(--transparent-red-20);
}

@media only screen and (max-width: 600px) {
  .dark-label {
    flex-basis: 100%;
  }
}

.next-button-container {
  margin-top: 2.5rem;
}

.choice-container {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}

input[type='radio']:focus + label {
  background-color: var(--transparent-red-20);
}

input[type='radio']:checked + label {
  color: var(--primary-white);
  background-color: var(--transparent-red-80);
}

.orange-text {
  color: var(--primary-white);
}
</style>
