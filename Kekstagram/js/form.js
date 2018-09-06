'use strict';

(function () {

  var uploadFile = document.querySelector('#upload-file');
  var uploadOverlay = document.querySelector('.upload-overlay');
  var overlayClose = document.querySelector('#upload-cancel');

  var textarea = document.querySelector('.upload-form-description');

  uploadFile.addEventListener('click', function () {
    uploadFile.value = '';

    transformValues = copyTransformValues.slice();
    imagePreview.style.transform = 'scale(' + transformValues[0] + ')';
    resizeControlsValue.value = '100%';
    resizeButtonDec.classList.remove('upload-resize-control-inactive');
    resizeButtonInc.classList.add('upload-resize-control-inactive');

    imagePreview.classList.toggle(imagePreview.classList[1], false);
    radios[0].checked = true;
    effectLevel.classList.add('hidden');
    imagePreview.style.filter = '';
    inputLevelValue.value = '';

    inputHashtag.setCustomValidity('');
    inputHashtag.style.border = '';
    inputHashtag.value = '';
    textarea.value = '';
  });

  uploadFile.addEventListener('change', function () {
    window.selectFile();
    window.switchPopupVisibility.openPopup(uploadOverlay);
  });

  overlayClose.addEventListener('click', function () {
    window.switchPopupVisibility.closePopup(uploadOverlay);
  });

  overlayClose.addEventListener('keydown', function (evt) {
    if (window.switchPopupVisibility.isEnterEvent(evt)) {
      window.switchPopupVisibility.closePopup(uploadOverlay);
    }
  });

  // Применение эффекта для изображения
  var imagePreview = document.querySelector('.effect-image-preview');
  var radios = document.querySelectorAll('[name = "effect"]');

  radios.forEach(function (radio, index) {
    radio.addEventListener('click', function () {
      var classEffect = radio.id.replace('upload-', '');
      if (index === 0) {
        effectLevel.classList.add('hidden');
      } else {
        effectLevel.classList.remove('hidden');
      }
      imagePreview.classList.toggle(imagePreview.classList[1], false);
      imagePreview.classList.toggle(classEffect);

      imagePreview.style.filter = '';
      effectPin.style.left = '455px';
      effectLevelVal.style.width = '100%';
      inputLevelValue.value = '100';
    });
  });

  // Слайдер
  var effectLevel = document.querySelector('.upload-effect-level');
  var effectLevelLine = effectLevel.querySelector('.upload-effect-level-line');
  var effectLevelVal = effectLevel.querySelector('.upload-effect-level-val');
  var effectPin = effectLevel.querySelector('.upload-effect-level-pin');

  var inputLevelValue = effectLevel.querySelector('.upload-effect-level-value');

  var maxLevelFilter = {
    'effect-chrome': 1,
    'effect-sepia': 1,
    'effect-marvin': 100,
    'effect-phobos': 5,
    'effect-heat': 3
  };

  var filters = {
    'effect-chrome': function (ratio) {
      return 'grayscale(' + ratio.toFixed(1) + ')';
    },
    'effect-sepia': function (ratio) {
      return 'sepia(' + ratio.toFixed(1) + ')';
    },
    'effect-marvin': function (ratio) {
      return 'invert(' + ratio.toFixed(1) + '%)';
    },
    'effect-phobos': function (ratio) {
      return 'blur(' + ratio.toFixed(1) + 'px)';
    },
    'effect-heat': function (ratio) {
      return 'brightness(' + ratio.toFixed(1) + ')';
    }
  };

  var changePinLocation = function (coordinateX) {
    var effectLineElement = {
      left: effectLevelLine.getBoundingClientRect().left,
      width: effectLevelLine.getBoundingClientRect().width
    };

    if (coordinateX >= effectLineElement.left && coordinateX <= (effectLineElement.left + effectLineElement.width)) {
      var userFilter = imagePreview.classList[1];
      var userValue = (maxLevelFilter[userFilter] * (coordinateX - effectLineElement.left) / effectLineElement.width);
      imagePreview.style.filter = filters[userFilter](userValue);

      var userPercent = (100 * (coordinateX - effectLineElement.left)) / effectLineElement.width;
      effectPin.style.left = userPercent + '%';
      effectLevelVal.style.width = userPercent + '%';
      inputLevelValue.value = Math.floor(userPercent);
    }
  };

  effectPin.addEventListener('mousedown', function (evt) {
    evt.preventDefault();

    var startX = evt.clientX;

    var onMouseMove = function (moveEvt) {
      moveEvt.preventDefault();

      startX = moveEvt.clientX;

      changePinLocation(startX);
    };

    var onMouseUp = function (upEvt) {
      upEvt.preventDefault();

      effectLevel.removeEventListener('mousemove', onMouseMove);
      document.removeEventListener('mouseup', onMouseUp);
    };

    effectLevel.addEventListener('mousemove', onMouseMove);
    document.addEventListener('mouseup', onMouseUp);
  });

  effectLevelLine.addEventListener('click', function (evt) {
    evt.preventDefault();

    var startX = evt.clientX;

    changePinLocation(startX);
  });

  // Редактирование размера изображения
  var resizeControlsValue = document.querySelector('.upload-resize-controls-value');
  var resizeButtonDec = document.querySelector('.upload-resize-controls-button-dec');
  var resizeButtonInc = document.querySelector('.upload-resize-controls-button-inc');
  var resizeControls = document.querySelector('.upload-resize-controls');

  var transformValues = [1, 0.75, 0.5, 0.25];
  var copyTransformValues = transformValues.slice();

  var changeScale = function (arr, target) {
    resizeButtonInc.classList.remove('upload-resize-control-inactive');
    resizeButtonDec.classList.remove('upload-resize-control-inactive');
    if (target.classList.contains('upload-resize-controls-button-dec')) {
      if (transformValues[0] !== 0.25) {
        transformIndex = arr.shift();
        arr.push(transformIndex);
      }
    } else if (target.classList.contains('upload-resize-controls-button-inc')) {
      if (transformValues[0] !== 1) {
        var transformIndex = arr.pop();
        arr.unshift(transformIndex);
      }
    }
    imagePreview.style.transform = 'scale(' + transformValues[0] + ')';
    resizeControlsValue.value = transformValues[0] * 100 + '%';
    if (transformValues[0] === 1) {
      resizeButtonInc.classList.add('upload-resize-control-inactive');
    } else if (transformValues[0] === 0.25) {
      resizeButtonDec.classList.add('upload-resize-control-inactive');
    }
  };

  resizeControls.addEventListener('click', function (evt) {
    var target = evt.target;
    while (target !== resizeControls) {
      if (target.classList.contains('upload-resize-controls-button')) {
        changeScale(transformValues, target);
      } else if (target.classList.contains('upload-resize-controls-value')) {
        transformValues = copyTransformValues.slice();
        imagePreview.style.transform = 'scale(' + transformValues[0] + ')';
        resizeControlsValue.value = '100%';
        resizeButtonDec.classList.remove('upload-resize-control-inactive');
        resizeButtonInc.classList.add('upload-resize-control-inactive');
      }
      target = target.parentNode;
    }
  });

  // Валидация формы
  var inputHashtag = document.querySelector('.upload-form-hashtags');

  var checkHashtag = function (currentValue) {
    if (!currentValue.length) {
      inputHashtag.setCustomValidity('');
      inputHashtag.style.border = '';
      return false;
    } else if (currentValue.charAt(0) !== '#') {
      inputHashtag.setCustomValidity('Хэш-тег должен начинаться с символа "#" и состоять из одного слова.');
      inputHashtag.style.border = '2px solid red';
      return true;
    } else if (currentValue.length < 2) {
      inputHashtag.setCustomValidity('Хэш-тег не может состоять только из символа "#".');
      inputHashtag.style.border = '2px solid red';
      return true;
    } else if (currentValue.length > 20) {
      inputHashtag.setCustomValidity('Максимальная длина одного хэш-тега 20 символов.');
      inputHashtag.style.border = '2px solid red';
      return true;
    } else {
      inputHashtag.setCustomValidity('');
      inputHashtag.style.border = '';
      return false;
    }
  };

  inputHashtag.addEventListener('input', function (evt) {
    var str = evt.target.value;
    var userHashtags = str.split(' ');

    if (userHashtags.length > 5) {
      inputHashtag.setCustomValidity('Нельзя указать больше пяти хэш-тегов.');
      inputHashtag.style.border = '2px solid red';
    } else if (!userHashtags.some(checkHashtag)) {
      var uniq = {};
      inputHashtag.style.border = '';
      inputHashtag.setCustomValidity('');
      for (var i = 0; i < userHashtags.length; i++) {
        if (uniq.hasOwnProperty(userHashtags[i].toLowerCase())) {
          inputHashtag.setCustomValidity('Один и тот же хэш-тег не может быть использован дважды.');
          inputHashtag.style.border = '2px solid red';
          return;
        } else {
          uniq[userHashtags[i].toLowerCase()] = true;
        }
      }
    }
  });

  // Отправка формы на сервер
  var form = document.querySelector('#upload-select-image');

  form.addEventListener('submit', function (evt) {
    window.backend.save(new FormData(form), function () {
      window.switchPopupVisibility.closePopup(uploadOverlay);
    }, window.errorHandler);
    evt.preventDefault();
  });

})();
