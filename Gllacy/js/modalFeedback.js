"use strict";

(function () {

    var buttonFeedback = document.querySelector('.contacts-button');
    var modalFeedback = document.querySelector('.modal-feedback');
    var modalOverlay = document.querySelector('.modal-overlay');

    var name = modalFeedback.querySelector('#feedback-name');
    var mail = modalFeedback.querySelector('#feedback-mail');
    var text = modalFeedback.querySelector('#feedback-text');

    var storageName = "";
    var storageMail = "";
    var isStorageSupport = true;

    try {
        storageName = localStorage.getItem("storageName");
        storageMail = localStorage.getItem("storageMail");
    } catch (err) {
        console.log("Нельзя использовать storage");
        isStorageSupport = false;
    }

    var closePopup = function (evt) {
        evt.preventDefault();

        modalFeedback.classList.remove('modal-show');
        modalOverlay.classList.remove('modal-show');

        window.removeEventListener('keydown', onPopupEscPress);
    };

    var onPopupEscPress = function (evt) {
        if (evt.keyCode === 27) {
            closePopup(evt);
        }
    }

    buttonFeedback.addEventListener('click', function (evt) {
        evt.preventDefault();

        modalFeedback.classList.add('modal-show');
        modalFeedback.style.top = String(document.documentElement.clientHeight/2 - modalFeedback.clientHeight/2) + 'px';

        modalOverlay.classList.add('modal-show');

        if (isStorageSupport) {
            if (storageName && storageMail) {
                name.value = storageName;
                mail.value = storageMail;
                text.focus();
            } else if (storageName) {
                name.value = storageName;
                mail.focus();
            } else if (storageMail) {
                mail.value = storageMail;
                name.focus();
            } else {
                name.focus();
            }
        } else {
            name.focus();
        }

        window.addEventListener('keydown', onPopupEscPress);
    });

    modalOverlay.addEventListener('click', function (evt) {
        closePopup(evt);
    })

    var closeButton = modalFeedback.querySelector('.modal-close');

    closeButton.addEventListener('click', function (evt) {
        closePopup(evt);
    });

    var form = modalFeedback.querySelector('.feedback-form');

    form.addEventListener('submit', function (evt) {
        if (!name.value || !mail.value) {
            evt.preventDefault();

        } else {
            localStorage.setItem('storageName', name.value);
            localStorage.setItem('storageMail', mail.value);
        }
    });

})();