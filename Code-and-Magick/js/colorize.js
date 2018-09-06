'use strict';

(function () {

  var COATS_COLORS = ['rgb(101, 137, 164)', 'rgb(241, 43, 107)', 'rgb(146, 100, 161)', 'rgb(56, 159, 117)', 'rgb(215, 210, 55)', 'rgb(0, 0, 0)'];
  var EYES_COLORS = ['black', 'red', 'blue', 'yellow', 'green'];
  var FIREBALL_COLORS = ['#ee4830', '#30a8ee', '#5ce6c0', '#e848d5', '#e6e848'];

  var coatsColorsCopy = COATS_COLORS.slice();
  var eyesColorsCopy = EYES_COLORS.slice();

  // Изменение цвета мантии, глаз и фаерболов по нажатию.
  var setup = document.querySelector('.setup');

  var wizardCoat = document.querySelector('.setup-wizard .wizard-coat');
  var wizardEyes = document.querySelector('.setup-wizard .wizard-eyes');
  var wizardFireball = document.querySelector('.setup-fireball-wrap');

  var inputCoat = setup.querySelector('input[name="coat-color"]');
  var inputEyes = setup.querySelector('input[name="eyes-color"]');
  var inputFireball = setup.querySelector('input[name="fireball-color"]');

  window.colorizeWizard = {
    colorCoat: '',
    colorEyes: '',
    colorFireball: ''
  };

  var changeColor = function (element, input, arr, str) {
    var color = arr.shift();
    arr.push(color);
    element.style[str] = arr[0];
    input.value = arr[0];
    return arr[0];
  };

  wizardCoat.addEventListener('click', function () {
    window.colorizeWizard.colorCoat = changeColor(wizardCoat, inputCoat, coatsColorsCopy, 'fill');
    window.debounce(window.updateWizards);
    return window.colorizeWizard.colorCoat;
  });

  wizardEyes.addEventListener('click', function () {
    window.colorizeWizard.colorEyes = changeColor(wizardEyes, inputEyes, eyesColorsCopy, 'fill');
    window.debounce(window.updateWizards);
    return window.colorizeWizard.colorEyes;
  });

  wizardFireball.addEventListener('click', function () {
    window.colorizeWizard.colorFireball = changeColor(wizardFireball, inputFireball, FIREBALL_COLORS, 'background');
    window.debounce(window.updateWizards);
    return window.colorizeWizard.colorFireball;
  });

})();
