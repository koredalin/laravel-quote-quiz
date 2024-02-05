

document.addEventListener('DOMContentLoaded', function () {
  const modeSelect = document.getElementById(`mode`);
  
  for (let i = 0; i < 10; i++) {

    const comboSelect = document.getElementById(`combo_select${i}`);
    const quoteSearch = document.getElementById(`quote_search${i}`);
    const quoteSelect = document.getElementById(`quote_id${i}`);
    let searchTimeout;
    let hideTimeout;

    function updateElementQuotes() {
      const searchText = quoteSearch.value.trim();

      if (searchText.length >= 3) {
        clearTimeout(searchTimeout);

        // Quote search timeout 1 second.
        searchTimeout = setTimeout(() => {

          fetch(`/api/admin/quotes/search/${modeSelect.value}/${searchText}`)
            .then(response => response.json())
            .then(data => {
              
              while (quoteSelect.firstChild) {
                quoteSelect.removeChild(quoteSelect.firstChild);
              }
              
              const option = document.createElement('option');
              option.value = '';
              option.textContent = 'Please, select';
              option.selected = true;
              quoteSelect.appendChild(option);

              // Добавете новите опции
              data.quotes.forEach(quote => {
                const option = document.createElement('option');
                option.value = quote.id;
                option.textContent = quote.question;
                quoteSelect.appendChild(option);
              });

              comboSelect.classList.add('active');
            })
            .catch(error => {
              console.error('Error:', error);
            });
        }, 1000);
      } else {
        // We hide the select if less than 3 chars added.
        comboSelect.classList.remove('active');
      }

    }

    quoteSelect.addEventListener('change', function () {
      // We copy the text from choosen select option into the input element.
      if (this.value) {
        quoteSearch.value = this.options[this.selectedIndex].textContent;
      }

      clearTimeout(hideTimeout);

      // Timeout and select hide after option change.
      hideTimeout = setTimeout(() => {
        comboSelect.classList.remove('active');
      }, 500);
    });

    quoteSelect.addEventListener('blur', function () {
      comboSelect.classList.remove('active');
    });

    updateElementQuotes();
    quoteSearch.addEventListener('input', updateElementQuotes);
  
  }
});
