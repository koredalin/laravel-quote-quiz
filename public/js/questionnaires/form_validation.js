document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('questionnaire_form');
    
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        
        fetch('/api/questionnaires/add_one_validation', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.errors) {
                const errorsContainer = document.getElementById('validation_errors');
                errorsContainer.innerHTML = '';

                data.errors.forEach(error => {
                    const errorElement = document.createElement('div');
                    errorElement.textContent = error;
                    errorsContainer.appendChild(errorElement);
                });
            } else {
                form.submit();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});