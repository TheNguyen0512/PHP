const fotget = document.getElementById('forget');
const snippet = document.getElementById('snippet');
const forgetEmail = document.getElementById('forget-email');
const messageForget = document.getElementById('message-forget-error');
const messageForgetEmail = document.getElementById('message-error-forget-email');
const alter = document.getElementById('alter');

window.onload = function () {
    fotget.style.display = 'block';
    snippet.style.display = 'none';
    alter.style.display = 'none';
    messageForgetEmail.innerHTML = '';
    messageForget.innerHTML = '';
};

function isEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function forgetPassowrd(){
    let checkEmail = true;
    if (forgetEmail.value === '') {     
        if (forgetEmail.classList.contains("is-invalid") === false) {
            forgetEmail.classList.add('is-invalid');
        }
        messageForgetEmail.innerHTML = 'Email cannot be blank';
        checkEmail = false;
    } else {
        if (isEmail(forgetEmail.value) === false) {
            if (forgetEmail.classList.contains("is-invalid") === false) {
                forgetEmail.classList.add('is-invalid');
            }
            messageForgetEmail.innerHTML = 'Email is not in the correct email format';
            checkEmail = false;
        } else {
            if (forgetEmail.classList.contains("is-invalid") === true) {
                forgetEmail.classList.remove('is-invalid');
            }
            messageForgetEmail.innerHTML = '';
            checkEmail = true;
        }
    }
    if (checkEmail) {
        messageForget.style.display = 'none';
        alter.style.display = 'none';
        fotget.style.display = 'none';
        snippet.style.display = 'flex';
        $.ajax({
            url: 'http://localhost:8000/api/forget-password',
            type: 'POST',
            dataType: 'json',
            data: { 'email': forgetEmail.value},
            success: function (response) {
                fotget.style.display = 'block';
                snippet.style.display = 'none';
                alter.style.display = 'block';
                alter.innerHTML = response.message;
            },
            error: function (response) {
                alter.style.display = 'none';
                fotget.style.display = 'block';
                snippet.style.display = 'none';
                messageForget.style.display = 'block';
                console.log(response)
                messageForget.innerHTML = response.message;
            }
        });
    }
}




