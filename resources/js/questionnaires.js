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
  if (!data.length) {
    return;
  }

  rightAnswers = {};
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
      answersDivHtml += '<div class="radio-answer"><input type="radio" name="' + radioName + '" id="' + radioName + '_a" value="a">&nbsp;&nbsp;';
      answersDivHtml += '<label for="' + radioName + '_a"><strong>' + quoteObj.answer_a + '</strong></label></div>';
      answersDivHtml += '<br>';
      answersDivHtml += '<div class="radio-answer"><input type="radio" name="' + radioName + '" id="' + radioName + '_b" value="b">&nbsp;&nbsp;';
      answersDivHtml += '<label for="' + radioName + '_b"><strong>' + quoteObj.answer_b + '</strong></label></div>';
      answersDivHtml += '<br>';
      answersDivHtml += '<div class="radio-answer"><input type="radio" name="' + radioName + '" id="' + radioName + '_c" value="c">&nbsp;&nbsp;';
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
    rightAnswerDiv.classList.add('red');
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
  questionsContainer.classList.remove('hidden');
  submitButton.classList.remove('hidden');

  const timerElement = document.getElementById('timer');
//    let time = durationInSeconds;
//    console.log(durationInSeconds);
  let time = 10;

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
console.log(rightAnswers);
      closeModal();
    }
  }, 1000);

};

window.startTimer = startTimer;