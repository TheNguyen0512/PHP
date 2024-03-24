const token = document.getElementById('token');
const email = document.getElementById('email');
const newPassword = document.getElementById('newPassword');
const confirmPassword = document.getElementById('confirmPassword');
const messagePassword = document.getElementById('message-error-reset-password');
const messageConfirmPassword = document.getElementById('message-error-reset-confirm-password');
const regexPassword = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

function resettPassowrd(){
    let checkPassword = true;
    let checkConfirmPassword = true;
    if (newPassword.value === '') {
        if (newPassword.classList.contains("is-invalid") === false) {
            newPassword.classList.add('is-invalid');
        }
        messagePassword.innerHTML = 'Password cannot be blank';
        checkPassword = false;
    } else {
        if (regexPassword.test(newPassword.value) === false) {
            if (newPassword.classList.contains("is-invalid") === false) {
                newPassword.classList.add('is-invalid');
            }
            messagePassword.innerHTML = 'Password must have:<br> - 1 capital letter.<br> - 1 number.<br> - 1 special character.<br> - Be at least 8 characters long';
            checkPassword = false;
        } else {
            if (newPassword.classList.contains("is-invalid") === true) {
                newPassword.classList.remove('is-invalid');
            }
            messagePassword.innerHTML = '';
            checkPassword = true;
        }
    }
    if (confirmPassword.value === '') {
        if (confirmPassword.classList.contains("is-invalid") === false) {
            confirmPassword.classList.add('is-invalid');
            messageConfirmPassword.innerHTML = 'Confirm password cannot be blank';
            checkConfirmPassword = false;
        }
    } else {
        if (confirmPassword.value !== newPassword.value) {
            if (confirmPassword.classList.contains("is-invalid") === false) {
                confirmPassword.classList.add('is-invalid');
            }
            messageConfirmPassword.innerHTML = 'Confirm password is not the same as password';
            checkConfirmPassword = false;
        } else {
            if (confirmPassword.classList.contains("is-invalid") === true) {
                confirmPassword.classList.remove('is-invalid');
            }
            messageConfirmPassword.innerHTML = '';
            checkConfirmPassword = true;
        }
    }

    if (checkPassword && checkConfirmPassword) {
        $.ajax({
            url: 'http://localhost:8000/api/reset-password',
            type: 'POST',
            dataType: 'json',
            data: { 'email': email.value, 'token':token.value, 'password':newPassword.value},
            success: function (response) {
                window.location = '/auth';
            },
            error: function (response) {
                console.log(response)
            }
        });
    }
}