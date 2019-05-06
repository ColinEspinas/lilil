function swapSignForms(bool) {
    if (bool) {
        document.querySelector('#signup-form').style.animation = "signFormOut 300ms 1";
        setTimeout(() => {
            document.querySelector('#signup-form').style.display = "none";
            document.querySelector('#login-form').style.display = "block";
            document.querySelector('#login-form').style.animation = "signFormIn 300ms 1";
            document.querySelector('#login-form').elements[1].focus();
        }, 200);
    } else {
        document.querySelector('#login-form').style.animation = "signFormOut 300ms 1";
        setTimeout(() => {
            document.querySelector('#login-form').style.display = "none";
            document.querySelector('#signup-form').style.display = "block";
            document.querySelector('#signup-form').style.animation = "signFormIn 300ms 1";
            document.querySelector('#signup-form').elements[1].focus();
        }, 200);
    }
}

function dropdownItem(name, bool) {
    if (bool) {
        document.querySelector("#" + name).style.display = "block";
        document.querySelector("#" + name).style.animation = "dropDownIn 100ms 1";
    } else {
        document.querySelector("#" + name).style.animation = "dropDownOut 100ms 1";
        setTimeout(() => {
            document.querySelector("#" + name).style.display = "none";
        }, 50);
    }
}

function toggleDropdown(name) {
    if (document.querySelector("#" + name).style.display == "none") {
        document.querySelector("#" + name).style.display = "block";
        document.querySelector("#" + name).style.animation = "dropDownIn 100ms 1";
    } else {
        document.querySelector("#" + name).style.animation = "dropDownOut 100ms 1";
        setTimeout(() => {
            document.querySelector("#" + name).style.display = "none";
        }, 50);
    }
}

window.onclick = function(e) {
    if (!event.target.matches('.dropdown-btn') && !event.target.matches('.dropdown-icon') && !event.target.matches('.nav-status')) {
        var dropdowns = document.getElementsByClassName("dropdown-item");
        for (let i = 0; i < dropdowns.length; i++) {
            dropdownItem(dropdowns[i].id, false);
        }
    }
}

function socialBtnAnimation(button) {
    if (!button.matches(".active")) {
        button.classList.add("active");
    } else {
        button.classList.remove('active');
    }
}

var xhttp = new XMLHttpRequest();

function likeDislike(message_id, token) {
    xhttp.open("PUT", "/likes/"+message_id, true);
    xhttp.setRequestHeader("X-CSRF-TOKEN", token);
    xhttp.send();
}