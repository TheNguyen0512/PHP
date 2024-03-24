const login = document.getElementById('sgin-in');
const register = document.getElementById('sgin-up');
const otp = document.getElementById('otp');
const otpInput = document.getElementById('otp-input');
const snippet = document.getElementById('snippet');
const emailLogin = document.getElementById('email-login');
const passwordLogin = document.getElementById('password-login');
const nameRegister = document.getElementById('name-register');
const emailRegister = document.getElementById('email-register');
const passwordRegister = document.getElementById('password-register');
const confirmPasswordRegister = document.getElementById('confirm-password-register');
const messageEmailLogin = document.getElementById('message-error-email-login');
const messagePasswordLogin = document.getElementById('message-error-password-login');
const messageNameRegister = document.getElementById('message-error-name-register');
const messageEmailRegister = document.getElementById('message-error-email-register');
const messagePasswordRegister = document.getElementById('message-error-password-register');
const messageConfirmPasswordRegister = document.getElementById('message-error-confirm-password-register');
const messageLogin = document.getElementById('message-login-error');
const messageRegister = document.getElementById('message-sgin-up-error');
const messageOtp = document.getElementById('message-otp-error');
let sginIn = true;
window.onload = function () {
    login.style.display = 'block';
    register.style.display = 'none';
    snippet.style.display = 'none';
    otp.style.display = 'none';
    messageLogin.style.display = 'none';
    messageOtp.style.display = 'none';
    messageLogin.innerHTML = '';
    messageOtp.innerHTML = '';
};

function isEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function checkLogin() {
    let checkEmail = true;
    let checkPassword = true;
   
    if (emailLogin.value === '') {     
        if (emailLogin.classList.contains("is-invalid") === false) {
            emailLogin.classList.add('is-invalid');
        }
        messageEmailLogin.innerHTML = 'Email cannot be blank';
        checkEmail = false;
    } else {
        if (isEmail(emailLogin.value) === false) {
            if (emailLogin.classList.contains("is-invalid") === false) {
                emailLogin.classList.add('is-invalid');
            }
            messageEmailLogin.innerHTML = 'Email is not in the correct email format';
            checkEmail = false;
        } else {
            if (emailLogin.classList.contains("is-invalid") === true) {
                emailLogin.classList.remove('is-invalid');
            }
            messageEmailLogin.innerHTML = '';
            checkEmail = true;
        }
    }
    if (passwordLogin.value === '') {
        if (passwordLogin.classList.contains("is-invalid") === false) {
            passwordLogin.classList.add('is-invalid');
        }
        messagePasswordLogin.innerHTML = 'Password cannot be blank';
        checkPassword = false;
    } else {
        if (passwordLogin.classList.contains("is-invalid") === true) {
            passwordLogin.classList.remove('is-invalid');
        }
        messagePasswordLogin.innerHTML = '';
        checkPassword = true;
    }
    if (checkEmail && checkPassword) {
        login.style.display = 'none';
        snippet.style.display = 'flex';
        $.ajax({
            url: 'http://localhost:8000/api/check-login',
            type: 'POST',
            dataType: 'json',
            data: { 'email': emailLogin.value, 'password': passwordLogin.value},
            success: function (response) {
                snippet.style.display = 'none';
                login.style.display = 'none';
                otp.style.display = 'block';
                otpInput.value = '';
                messageLogin.style.display = 'none';
                messageLogin.innerHTML = '';
            },
            error: function (response) {
                snippet.style.display = 'none';
                login.style.display = 'block';
                messageLogin.style.display = 'block';
                messageLogin.innerHTML = response.responseJSON.message;
            }
        });
    }
}

function checkRegsiter() {
    let checkName = true;
    let checkEmail = true;
    let checkPassword = true;
    let checkConfirmPassword = true;
    const regexPassword = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (nameRegister.value === '') {
        if (nameRegister.classList.contains("is-invalid") === false) {
            nameRegister.classList.add('is-invalid');
        }
        messageNameRegister.innerHTML = 'Name cannot be blank';
        checkName = false;
    } else {
        if (nameRegister.classList.contains("is-invalid") === true) {
            nameRegister.classList.remove('is-invalid');
        }
        messageNameRegister.innerHTML = '';
        checkName = true;
    }
    if (emailRegister.value === '') {
        if (emailRegister.classList.contains("is-invalid") === false) {
            emailRegister.classList.add('is-invalid');
        }
        messageEmailRegister.innerHTML = 'Email cannot be blank';
        checkEmail = false;
    } else {
        if (isEmail(emailRegister.value) === false) {
            if (emailRegister.classList.contains("is-invalid") === false) {
                emailRegister.classList.add('is-invalid');
            }
            messageEmailRegister.innerHTML = 'Email is not in the correct email format';
            checkEmail = false;
        } else {
            if (emailRegister.classList.contains("is-invalid") === true) {
                emailRegister.classList.remove('is-invalid');
            }
            messageEmailRegister.innerHTML = '';
            checkEmail = true;
        }
    }
    if (passwordRegister.value === '') {
        if (passwordRegister.classList.contains("is-invalid") === false) {
            passwordRegister.classList.add('is-invalid');
        }
        messagePasswordRegister.innerHTML = 'Password cannot be blank';
        checkPassword = false;
    } else {
        if (regexPassword.test(passwordRegister.value) === false) {
            if (passwordRegister.classList.contains("is-invalid") === false) {
                passwordRegister.classList.add('is-invalid');
            }
            messagePasswordRegister.innerHTML = 'Password must have:<br> - 1 capital letter.<br> - 1 number.<br> - 1 special character.<br> - Be at least 8 characters long';
            checkPassword = false;
        } else {
            if (passwordRegister.classList.contains("is-invalid") === true) {
                passwordRegister.classList.remove('is-invalid');
            }
            messagePasswordRegister.innerHTML = '';
            checkPassword = true;
        }
    }
    if (confirmPasswordRegister.value === '') {
        if (confirmPasswordRegister.classList.contains("is-invalid") === false) {
            confirmPasswordRegister.classList.add('is-invalid');
            messageConfirmPasswordRegister.innerHTML = 'Confirm password cannot be blank';
            checkConfirmPassword = false;
        }
    } else {
        if (confirmPasswordRegister.value !== passwordRegister.value) {
            if (confirmPasswordRegister.classList.contains("is-invalid") === false) {
                confirmPasswordRegister.classList.add('is-invalid');
            }
            messageConfirmPasswordRegister.innerHTML = 'Confirm password is not the same as password';
            checkConfirmPassword = false;
        } else {
            if (confirmPasswordRegister.classList.contains("is-invalid") === true) {
                confirmPasswordRegister.classList.remove('is-invalid');
            }
            messageConfirmPasswordRegister.innerHTML = '';
            checkConfirmPassword = true;
        }
    }

    if (checkName && checkEmail && checkPassword && checkConfirmPassword) {
        register.style.display = 'none';
        snippet.style.display = 'flex';
        $.ajax({
            url: 'http://localhost:8000/api/check-register',
            type: 'POST',
            dataType: 'json',
            data: {'name':nameRegister.value, 'email': emailRegister.value, 'password': passwordRegister.value},
            success: function (response) {
                snippet.style.display = 'none';
                register.style.display = 'none';
                otp.style.display = 'block';
                otpInput.value = '';
                messageRegister.style.display = 'none';
                messageRegister.innerHTML = '';
            },
            error: function (response) {
                snippet.style.display = 'none';
                register.style.display = 'block';
                messageRegister.style.display = 'block';
                messageRegister.innerHTML = response.responseJSON.message;
            }
        });
    }
}

function verify() {
    otp.style.display = 'none';
    snippet.style.display = 'flex';
    if (otpInput.value !== null || otpInput.value !== undefined) {
        if(sginIn){
            $.ajax({
                url: 'http://localhost:8000/api/login',
                type: 'POST',
                dataType: 'json',
                data: { 'email': emailLogin.value, 'password': passwordLogin.value, 'otp': otpInput.value },
                success: function (response) {
                    window.location.href = '/'; 
                },
                error: function (response) {
                    otp.style.display = 'block';
                    snippet.style.display = 'none';
                    messageOtp.style.display = 'block';
                    messageOtp.innerHTML = response.responseJSON.message;
                }
            });
        } else{
            console.log("resgister")
            $.ajax({
                url: 'http://localhost:8000/api/register',
                type: 'POST',
                dataType: 'json',
                data: {'name':nameRegister.value, 'email': emailRegister.value, 'password': passwordRegister.value, 'otp': otpInput.value },
                success: function (response) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Sign up successfully'
                    })
                    otp.style.display = 'none';
                    snippet.style.display = 'none';
                    login.style.display = 'block';
                    sginIn = true;
                },
                error: function (response) {
                    otp.style.display = 'block';
                    snippet.style.display = 'none';
                    console.log(response)
                    // messageLogin.style.display = 'block';
                    // messageLogin.innerHTML = response.responseJSON.message;
                }
            });
        }  
    }
}

function moveSginUp() {
    sginIn = false;
    login.style.display = 'none';
    register.style.display = 'block';
    document.getElementById('email-login').value = '';
    document.getElementById('password-login').value = '';
    if (emailLogin.classList.contains("is-invalid") === true) {
        emailLogin.classList.remove('is-invalid');
    }
    if (passwordLogin.classList.contains("is-invalid") === true) {
        passwordLogin.classList.remove('is-invalid');
    }
    messageEmailLogin.innerHTML = '';
    messagePasswordLogin.innerHTML = ''; 
}

function moveSginIn() {
    sginIn = true;;
    login.style.display = 'block';
    register.style.display = 'none';
    document.getElementById('email-register').value = '';
    document.getElementById('password-register').value = '';
    document.getElementById('confirm-password-register').value = '';
    if (emailRegister.classList.contains("is-invalid") === true) {
        emailRegister.classList.remove('is-invalid');
    }
    if (passwordRegister.classList.contains("is-invalid") === true) {
        passwordRegister.classList.remove('is-invalid');
    }
    if (confirmPasswordRegister.classList.contains("is-invalid") === true) {
        confirmPasswordRegister.classList.remove('is-invalid');
    }
    messageEmailRegister.innerHTML = '';
    messagePasswordRegister.innerHTML = '';
    messageConfirmPasswordRegister.innerHTML = '';
}
