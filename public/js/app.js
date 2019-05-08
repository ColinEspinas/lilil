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

function dropdownItem(element, bool) {
    if (bool) {
        element.nextElementSibling.style.display = "block";
        element.nextElementSibling.style.animation = "dropDownIn 100ms 1";
    } else {
        element.nextElementSibling.style.animation = "dropDownOut 100ms 1";
        setTimeout(() => {
            element.nextElementSibling.style.display = "none";
        }, 50);
    }
}

function toggleDropdown(element) {
    console.log(element.nextElementSibling)
    if (element.nextElementSibling.style.display == "none") {
        element.nextElementSibling.style.display = "block";
        element.nextElementSibling.style.animation = "dropDownIn 100ms 1";
    } else {
        element.nextElementSibling.style.animation = "dropDownOut 100ms 1";
        setTimeout(() => {
            element.nextElementSibling.style.display = "none";
        }, 50);
    }
}

window.onclick = function(e) {
    if (!event.target.matches('.dropdown-btn') && !event.target.matches('.dropdown-icon') && !event.target.matches('.nav-status') && !event.target.matches('polyline')) {
        console.log(event.target);
        var dropdowns = document.getElementsByClassName("dropdown-btn");
        for (let i = 0; i < dropdowns.length; i++) {
            dropdownItem(dropdowns[i], false);
        }
    }
}

function socialBtnAnimation(button) {
    if (!button.matches(".active")) {
        Array.prototype.forEach.call(button.children[0].children, element => {
            if (element.matches("span")) {
                element.innerText = parseInt(element.innerText, 10) + 1;
            }
        });
        button.classList.add("active");
    } else {
        Array.prototype.forEach.call(button.children[0].children, element => {
            if (element.matches("span")) {
                element.innerText -= 1;
            }
        });
        button.classList.remove('active');
    }
}

function followBtnAnimation(button) {
    if (!button.matches(".active")) {
        button.innerHTML = `<i data-feather="user-minus"></i> Unfollow`;
        feather.replace();
        button.classList.add("active");
    } else {
        button.innerHTML = `<i data-feather="user-plus"></i> Follow`;
        feather.replace();
        button.classList.remove('active');
    }
}

function ajax(url, method, token) {
    var xhttp = new XMLHttpRequest();
    xhttp.open(method, url, true);
    xhttp.setRequestHeader("X-CSRF-TOKEN", token);
    xhttp.send();
}

function deleteMessage(msgID) {
    document.querySelector("#message-delete-form-" + msgID).style.display = "block";
    document.querySelector("#message-delete-form-" + msgID).style.animation = "dropDownIn 200ms 1";
}

function editMessage(msgID) {
    document.querySelector("#message-edit-form-" + msgID).style.display = "block";
    document.querySelector("#message-edit-form-" + msgID).style.animation = "dropDownIn 200ms 1";
}

function quitDeleteMessage(msgID) {
    document.querySelector("#message-delete-form-" + msgID).style.animation = "dropDownOut 200ms 1";
    setTimeout(() => {
        document.querySelector("#message-delete-form-" + msgID).style.display = "none";
    }, 100);
}

function quitEditMessage(msgID) {
    document.querySelector("#message-edit-form-" + msgID).style.animation = "dropDownOut 200ms 1";
    setTimeout(() => {
        document.querySelector("#message-edit-form-" + msgID).style.display = "none";
    }, 100);
}