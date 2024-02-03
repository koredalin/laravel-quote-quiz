let loadQuestions = function (questionnaireId) {
  fetch(`/api/questionnaires/${questionnaireId}/quotes`)
    .then(response => response.json())
    .then(data => {
      console.log(data);
      updateModal(data);
    })
    .catch(error => console.error('Error:', error));
};

let rightAnswers = {};

let updateModal = function (data) {
  rightAnswers = {};
  if (!data.length) {
    return;
  }

  let quotesContainer = document.getElementById('questions_container');
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
    rightAnswerDiv.classList.add('hidden');
    rightAnswerDiv.classList.add('green');
    rightAnswerDiv.innerHTML = 'Correct! The right answer is "<strong>' + answer + '</strong>".';
    // Wrong answer, hidden.
    let wrongAnswerDiv = document.createElement('DIV');
    rightAnswerDiv.classList.add('hidden');
    rightAnswerDiv.classList.add('darkred');
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
  const timerStartButton = document.querySelector('#timer_start_button');
  timerStartButton.classList.add('hidden');

  const questionsContainer = document.querySelector('#questions_container');
  const submitButton = document.querySelector('form button[type="submit"]');
  const unansweredQuestionsDiv = document.getElementById('unanswer_questions_number');
  const unansweredQuestionsValSpan = document.getElementById('unanswer_questions_number_val');
  const allAnswersRadio = document.querySelectorAll('input[name^=quote_answer]');
  questionsContainer.classList.remove('hidden');
  submitButton.classList.remove('hidden');

  const timerElement = document.getElementById('timer');
//    let time = durationInSeconds;
//    console.log(durationInSeconds);
  let time = 5;

  function updateTimerDisplay() {
    const hours = Math.floor(time / (60 * 60));
    const minutes = Math.floor(time / 60);
    const seconds = time % 60;
    timerElement.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
  }

  updateTimerDisplay();

  const timerInterval = setInterval(() => {
    time--;
    updateTimerDisplay();
    if (time === 0) {
      clearInterval(timerInterval);
      timerStartButton.classList.remove('hidden');
      questionsContainer.classList.add('hidden');
      submitButton.classList.add('hidden');
      unansweredQuestionsValSpan.innerHTML = Object.keys(rightAnswers).length - getAnsweredQuestionsCount();
      unansweredQuestionsDiv.classList.remove('hidden');
      Object.values(allAnswersRadio).forEach(radio => {
        radio.checked = false;
      });
console.log(rightAnswers);
//      closeModal();
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
    console.log(radioName);
    const answerRadio = document.querySelector('input[name='+radioName+']:checked');
    if (answerRadio) {
      count++;
    }
  });
  
  return count;
};