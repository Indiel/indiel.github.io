"use strict";

(function () {
    
    var loginLink = document.querySelector(".login-link");
    var modalLogin  = document.querySelector(".modal-login");
    var login = modalLogin.querySelector("[name=login]");
    var password = modalLogin.querySelector("[name=password]");

    var buttonsMap = document.querySelectorAll(".button-map");
    var modalMap = document.querySelector(".modal-map");

    var storageLogin = "";
    var isStorageSupport = true;

    try {
        storageLogin = localStorage.getItem("storageLogin");
    } catch (err) {
        console.log("Нельзя использовать storage");
        isStorageSupport = false;
    }

    var onPopupEscPress = function (evt) {
        if (evt.keyCode === 27) {
            evt.preventDefault();
            closePopup(evt, window.openModal);
        }
    }

    var openPopup = function (evt, modal) {
        evt.preventDefault();
        window.openModal = modal;
        modal.classList.toggle("modal-show");
        modal.classList.remove("modal-error");

        window.addEventListener("keydown", onPopupEscPress);
    };

    var closePopup =  function (evt, modal) {
        evt.preventDefault();
        modal.classList.remove("modal-show");

        window.removeEventListener("keydown", onPopupEscPress);
    };

    loginLink.addEventListener("click", function (evt) {
        openPopup(evt, modalLogin);

        if (storageLogin) {
            login.value = storageLogin;
            password.focus();
        } else {
            login.focus();
        }
    });

    Array.from(buttonsMap).forEach(element => {
        element.addEventListener("click", function (evt) {
            evt.preventDefault();
            openPopup(evt, modalMap);
        });
    });
    
    var modalClose = document.querySelectorAll(".modal-close");

    [].map.call(modalClose, function (it) {
        it.addEventListener("click", function (evt) {
            closePopup(evt, it.parentElement);
        });
    }); 

    var form = modalLogin.querySelector("form");

    form.addEventListener("submit", function (evt) {  
        if (!login.value || !password.value) {
            evt.preventDefault();

            modalLogin.classList.remove("modal-error");
            modalLogin.offsetWidth;
            modalLogin.classList.add("modal-error");
        } else {
            if (isStorageSupport) {
                localStorage.setItem("storageLogin", login.value);
            }
        }
    });

})();