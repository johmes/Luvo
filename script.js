window.addEventListener('load', () => {
  darkMode();
  registerSW();
});

function darkMode() {
  var bodyEl = document.querySelector('body');

  var darkMode = () => {
    bodyEl.classList.toggle('dark');
  }

  // Get the value of the "dark" item from the local localStorage
  var setDarkMode = localStorage.getItem('dark');

  // Check dark mode if it is on or off on page reload
  if (setDarkMode === 'on') {
    darkMode();
  }
}

async function registerSW() {
  // Check if sw is supported
  if ('serviceWorker' in navigator) {
    try {
      console.log('Service worker toimii');
      await navigator.serviceWorker.register('sw.js');
    } catch (e) {
      console.log('SW regiteration failed');
    }
  }
}
