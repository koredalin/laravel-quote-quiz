function loadQuestions(questionnaireId) {
    fetch(`/api/questionnaires/${questionnaireId}/quotes`)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            updateModal(data);
        })
        .catch(error => console.error('Error:', error));
}

function updateModal(data) {
    if (!data.length) {
        return;
    }

    let container = document.getElementById('questionsContainer');
    let brElem = document.createElement('BR');
    data.forEach(function(quoteObj) {
        let quoteDiv = document.createElement('DIV');
        quoteDiv.className = 'quote';
        let isBinaryModeQuote = quoteObj.mode === 'binary';
        let questionDiv = document.createElement('DIV');
        questionDiv.className = 'quote-question';
        let answersDiv = document.createElement('DIV');
        answersDiv.className = 'quote-answers';
        let answer = quoteObj.right_answer;
        let radioName = 'quote_answer'+quoteObj.id;
        if (isBinaryModeQuote) {
            questionDiv.innerHTML = quoteObj.question;
            answersDiv.innerHTML = '<div class="radio-answer"><input type="radio" name="'+radioName+'" id="'+radioName+'_1" value="1">&nbsp;&nbsp;';
            answersDiv.innerHTML += '<label for="'+radioName+'_1"><strong>Yes</strong></label></div>';
            answersDiv.innerHTML += '<br>';
            answersDiv.innerHTML += '<div class="radio-answer"><input type="radio" name="'+radioName+'" id="'+radioName+'_0" value="0">&nbsp;&nbsp;';
            answersDiv.innerHTML += '<label for="'+radioName+'_0"><strong>No</strong></label></div>';
            answer = answer === '1' ? 'Yes' : 'No';
        } else {
            questionDiv.innerHTML = quoteObj.question;
            let answersDivHtml = '<div class="radio-answer"><input type="radio" name="'+radioName+'" id="'+radioName+'_a" value="a">&nbsp;&nbsp;';
            
            answersDivHtml += '<label for="'+radioName+'_a"><strong>'+quoteObj.answer_a+'</strong></label></div>';
            answersDivHtml += '<br>';
            answersDivHtml += '<div class="radio-answer"><input type="radio" name="'+radioName+'" id="'+radioName+'_b" value="b">&nbsp;&nbsp;';
            answersDivHtml += '<label for="'+radioName+'_b"><strong>'+quoteObj.answer_b+'</strong></label></div>';
            answersDivHtml += '<br>';
            answersDivHtml += '<div class="radio-answer"><input type="radio" name="'+radioName+'" id="'+radioName+'_c" value="c">&nbsp;&nbsp;';
            answersDivHtml += '<label for="'+radioName+'_c"><strong>'+quoteObj.answer_c+'</strong></label></div>';
            answersDiv.innerHTML = answersDivHtml;
        }
        answersDiv.innerHTML += '<div class="clear"></div>';
        quoteDiv.appendChild(questionDiv);
        quoteDiv.appendChild(answersDiv);
        let rightAnswerDiv = document.createElement('DIV');
        rightAnswerDiv.className = 'hidden green';
        rightAnswerDiv.innerHTML = 'Correct! The right answer is "<strong>'+answer+'</strong>".';
        let wrongAnswerDiv = document.createElement('DIV');
        wrongAnswerDiv.className = 'hidden red';
        wrongAnswerDiv.innerHTML = 'Sorry, you are wrong! The right answer is "<strong>'+answer+'</strong>".';
        quoteDiv.appendChild(rightAnswerDiv);
        quoteDiv.appendChild(wrongAnswerDiv);
        quoteDiv.appendChild(brElem);
        quoteDiv.appendChild(brElem);
        container.appendChild(quoteDiv);
    });
}

window.loadQuestions = loadQuestions;