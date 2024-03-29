let loadedQuestionnnaireId = 0;
let rightAnswers = {};
let timerInterval = null;
let sessionRemainingTime = 0;

let loadQuestions = function (questionnaireId) {
  fetch(`/api/questionnaires/${questionnaireId}/quotes`)
    .then(response => response.json())
    .then(data => {
      updateModal(data);
      loadedQuestionnnaireId = questionnaireId;
    })
    .catch(error => console.error('Error:', error));
};

let updateModal = function (data) {
  rightAnswers = {};
  if (!data.length) {
    return;
  }

  let quotesContainer = document.getElementById('questions_container');
  quotesContainer.innerHTML = '';
  quotesContainer.classList.add('hidden');
  data.forEach(function (quoteObj) {
    let quoteDiv = document.createElement('DIV');
    quoteDiv.className = 'quote';
    let isBinaryMode = quoteObj.mode === 'binary';
    // Question
    let questionDiv = document.createElement('DIV');
    questionDiv.className = 'quote-question';
    questionDiv.innerHTML = quoteObj.question;
    // Answers
    let answersDiv = document.createElement('DIV');
    answersDiv.className = 'quote-answers';
    let answer = quoteObj.right_answer;
    let radioName = 'quote_answer' + quoteObj.id;
    rightAnswers[radioName] = answer;
    let answersDivHtml = '';
    if (isBinaryMode) {
      // Binary answers.
      answersDivHtml += '<div class="radio-answer"><input type="radio" name="' + radioName + '" id="' + radioName + '_1" value="1">&nbsp;&nbsp;';
      answersDivHtml += '<label for="' + radioName + '_1"><strong>Yes</strong></label></div>';
      answersDivHtml += '<br>';
      answersDivHtml += '<div class="radio-answer"><input type="radio" name="' + radioName + '" id="' + radioName + '_0" value="0">&nbsp;&nbsp;';
      answersDivHtml += '<label for="' + radioName + '_0"><strong>No</strong></label></div>';
      answer = answer === '1' ? 'Yes' : 'No';
    } else {
      // Multiple choice ("A", "B", "C") answers.
      answersDivHtml += '<div class="radio-answer"><input type="radio" name="' + radioName + '" id="' + radioName + '_a" value="A">&nbsp;&nbsp;';
      answersDivHtml += '<label for="' + radioName + '_a"><strong>' + quoteObj.answer_a + '</strong></label></div>';
      answersDivHtml += '<br>';
      answersDivHtml += '<div class="radio-answer"><input type="radio" name="' + radioName + '" id="' + radioName + '_b" value="B">&nbsp;&nbsp;';
      answersDivHtml += '<label for="' + radioName + '_b"><strong>' + quoteObj.answer_b + '</strong></label></div>';
      answersDivHtml += '<br>';
      answersDivHtml += '<div class="radio-answer"><input type="radio" name="' + radioName + '" id="' + radioName + '_c" value="C">&nbsp;&nbsp;';
      answersDivHtml += '<label for="' + radioName + '_c"><strong>' + quoteObj.answer_c + '</strong></label></div>';
    }

    answersDiv.innerHTML = answersDivHtml;
    answersDiv.innerHTML += '<div class="clear"></div>';
    quoteDiv.appendChild(questionDiv);
    quoteDiv.appendChild(answersDiv);
    // Right answer, hidden.
    let rightAnswerDiv = document.createElement('DIV');
    rightAnswerDiv.id = radioName+'_success';
    rightAnswerDiv.classList.add('hidden');
    rightAnswerDiv.classList.add('green');
    rightAnswerDiv.innerHTML = 'Correct! The right answer is "<strong>' + answer + '</strong>".';
    // Wrong answer, hidden.
    let wrongAnswerDiv = document.createElement('DIV');
    wrongAnswerDiv.id = radioName+'_fail';
    wrongAnswerDiv.classList.add('hidden');
    wrongAnswerDiv.classList.add('darkred');
    wrongAnswerDiv.innerHTML = 'Sorry, you are wrong! The right answer is "<strong>' + answer + '</strong>".';
    quoteDiv.appendChild(rightAnswerDiv);
    quoteDiv.appendChild(wrongAnswerDiv);
    quotesContainer.appendChild(quoteDiv);
  });

  // Shows the container.
  let modalContainer = document.getElementById('modal');
  modalContainer.classList.remove('hidden');
};

window.loadQuestions = loadQuestions;

/*************** Modal Close *****************/

let closeModal = function () {
  let modalContainer = document.getElementById('modal');
  modalContainer.classList.add('hidden');
};

window.closeModal = closeModal;

/*************** Timer Start *****************/

let startTimer = function () {
  const timerStartButton = document.getElementById('timer_start_button');
  timerStartButton.classList.add('hidden');

  const questionsContainer = document.querySelector('#questions_container');
  const submitButton = document.getElementById('submit');
  const unansweredQuestionsDiv = document.getElementById('unanswer_questions_number');
  const unansweredQuestionsValSpan = document.getElementById('unanswer_questions_number_val');
  const allAnswersRadio = document.querySelectorAll('input[name^=quote_answer]');
  questionsContainer.classList.remove('hidden');
  submitButton.classList.remove('hidden');

  let sessionRemainingTime = durationInSeconds;

  updateTimerDisplay();

  timerInterval = setInterval(() => {
    sessionRemainingTime--;
    updateTimerDisplay();
    if (sessionRemainingTime === 0) {
      clearInterval(timerInterval);
      questionsContainer.classList.add('hidden');
      submitButton.classList.add('hidden');
      unansweredQuestionsValSpan.innerHTML = Object.keys(rightAnswers).length - getAnsweredQuestionsCount();
      unansweredQuestionsDiv.classList.remove('hidden');
      Object.values(allAnswersRadio).forEach(radio => {
        radio.checked = false;
      });
      
      document.getElementById('reset_button').classList.remove('hidden');
    }
  }, 1000);

};

window.startTimer = startTimer;

let getAnsweredQuestionsCount = function () {
  if (Object.keys(rightAnswers).length === 0) {
    return 0;
  }
  
  let count = 0;
  Object.keys(rightAnswers).forEach(radioName => {
    const answerRadio = document.querySelector('input[name='+radioName+']:checked');
    if (answerRadio) {
      count++;
    }
  });
  
  return count;
};

let updateTimerDisplay =  function () {
  const timerElement = document.getElementById('timer');
  const hours = Math.floor(sessionRemainingTime / (60 * 60));
  const minutes = Math.floor(sessionRemainingTime / 60);
  const seconds = sessionRemainingTime % 60;
  timerElement.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
};

let stopTimer = function () {
  if (timerInterval) {
    clearInterval(timerInterval);
  }
};

/********************* RESET **************************/

let reset = function () {
  const unansweredQuestionsDiv = document.getElementById('unanswer_questions_number');
  const resetButton = document.getElementById('reset_button');
  const timerStartButton = document.getElementById('timer_start_button');
  unansweredQuestionsDiv.classList.add('hidden');
  resetButton.classList.add('hidden');
  loadQuestions(loadedQuestionnnaireId);
  timerStartButton.classList.remove('hidden');
  stopTimer();
  sessionRemainingTime = durationInSeconds;
  updateTimerDisplay();
};

window.reset = reset;

/********************* SUBMIT **************************/

let submit = function () {
  showQuestionnaireResult();
  submitForm();
  saveToLocalStorage(
      document.querySelector('input[name="name"]').value,
      document.querySelector('input[name="surname"]').value,
      document.querySelector('input[name="email"]').value
  );
  stopTimer();
  sessionRemainingTime = durationInSeconds;
  updateTimerDisplay();
  document.getElementById('reset_button').classList.remove('hidden');
  document.getElementById('submit').classList.add('hidden');
};

window.submit = submit;

let getUserRightAnswers = function () {
  let userRightAnswers = {};
  Object.entries(rightAnswers).forEach(entry => {
    const [radioName, rightAnswer] = entry;
    const answerRadio = document.querySelector('input[name='+radioName+']:checked');
    if (answerRadio && rightAnswer === answerRadio.value) {
      userRightAnswers[radioName] = rightAnswer;
    }
  });
  
  return userRightAnswers;
};

let showQuestionnaireResult = function () {
  Object.entries(rightAnswers).forEach(entry => {
    const [radioName, rightAnswer] = entry;
    const answerRadio = document.querySelector('input[name='+radioName+']:checked');
    let resultDiv = answerRadio && rightAnswer === answerRadio.value
      ? document.getElementById(radioName+'_success')
      : document.getElementById(radioName+'_fail');
    resultDiv.classList.remove('hidden');
  });
};

let submitForm = function () {
  let submitDate = new Date();
  let submitTimeUtc = submitDate.toUTCString();
  let formData = {
    name: document.querySelector('input[name="name"]').value,
    surname: document.querySelector('input[name="surname"]').value,
    email: document.querySelector('input[name="email"]').value,
    total_score: Object.keys(getUserRightAnswers()).length,
    unanswered_questions_count: Object.keys(rightAnswers).length - getAnsweredQuestionsCount(),
    time_elapsed: durationInSeconds - sessionRemainingTime,
    submit_time: submitTimeUtc
  };
  Object.keys(rightAnswers).forEach(radioName => {
    const answerRadio = document.querySelector('input[name='+radioName+']:checked');
    formData[radioName] = answerRadio ? answerRadio.value : '';
  });

  axios.post('/api/questionnaire/'+loadedQuestionnnaireId+'/submit', formData)
    .then((response) => {
      // TODO - Show if the result is successfully submited.
    })
    .catch((error) => {
      console.error(error);
    });
};