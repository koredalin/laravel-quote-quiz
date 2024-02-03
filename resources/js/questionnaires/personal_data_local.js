// The file saves user's personal data like name, surname, email into the local storage.

function saveToLocalStorage(name, surname, email) {
  const userData = {
    name: name,
    surname: surname,
    email: email
  };
  const expirationTime = Date.now() + 3600 * 1000;

  const dataToStore = {
    data: userData,
    expires: expirationTime,
  };

  localStorage.setItem('userData', JSON.stringify(dataToStore));

  // We start one hour timer before deleting the data from the local storage.
  setTimeout(clearLocalStorage, 3600 * 1000);
}

// Extracting the data from Local Storage.
function loadLocalStorageData() {
  const storedData = localStorage.getItem('userData');
  if (storedData) {
    const parsedData = JSON.parse(storedData);
    if (Date.now() <= parsedData.expires) {
      // We fill the form with the data from local storage.
      document.querySelector('input[name="name"]').value = parsedData.data.name;
      document.querySelector('input[name="surname"]').value = parsedData.data.surname;
      document.querySelector('input[name="email"]').value = parsedData.data.email;
    } else {
      // Removes all the data if the time is up.
      clearLocalStorage();
    }
  }
}

// Delete all the data.
function clearLocalStorage() {
  localStorage.removeItem('userData');
}

window.saveToLocalStorage = saveToLocalStorage;
window.loadLocalStorageData = loadLocalStorageData;

document.addEventListener('DOMContentLoaded', function() {
  loadLocalStorageData();
});
