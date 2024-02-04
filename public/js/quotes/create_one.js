document.addEventListener('DOMContentLoaded', function () {
    const modeSelect = document.getElementById('mode');
    const answerAInput = document.getElementById('answer_a');
    const answerAFormGroup = answerAInput.parentNode;
    const answerBInput = document.getElementById('answer_b');
    const answerBFormGroup = answerBInput.parentNode;
    const answerCInput = document.getElementById('answer_c');
    const answerCFormGroup = answerCInput.parentNode;
    const rightAnswerSelect = document.getElementById('right_answer');

    function updateVisibility() {
        const selectedMode = modeSelect.value;

        // We hide multiple choice answers and unselect the right_answer select option.
        answerAFormGroup.style.display = 'none';
        answerBFormGroup.style.display = 'none';
        answerCFormGroup.style.display = 'none';
        rightAnswerSelect.options[rightAnswerSelect.selectedIndex].selected = false;

        // We show and hide inputs and options by selected mode.
        if (selectedMode === 'binary') {
            answerAFormGroup.style.display = 'none';
            answerBFormGroup.style.display = 'none';
            answerCFormGroup.style.display = 'none';
            showHideModeBinaryOptions();
        } else if (selectedMode === 'multiple_choice') {
            answerAFormGroup.style.display = 'block';
            answerBFormGroup.style.display = 'block';
            answerCFormGroup.style.display = 'block';
            showHideModeMultipleChoiceOptions();
        }
    }
    
    function showHideModeBinaryOptions() {
      let options = rightAnswerSelect.options;
      let allowedOptions = ['0', '1'];
      Object.values(options).forEach(option => {
        if (modeSelect.value === 'binary' && allowedOptions.includes(option.value)) {
          option.classList.remove('hidden');
        } else {
          option.classList.add('hidden');
        }
      });
    }
    
    function showHideModeMultipleChoiceOptions() {
      let options = rightAnswerSelect.options;
      let allowedOptions = ['A', 'B', 'C'];
      Object.values(options).forEach(option => {
        if (modeSelect.value === 'multiple_choice' && allowedOptions.includes(option.value)) {
          option.classList.remove('hidden');
        } else {
          option.classList.add('hidden');
        }
      });
    }

    updateVisibility();
    modeSelect.addEventListener('change', updateVisibility);
});
