const dropDown = document.querySelector('.profileDropdown');
const reviewDetail = document.querySelector('.tablePopup');
const eye = document.getElementById('eye');
const eyee = document.getElementById('eyee');
const eyeee = document.getElementById('eyeee');
const oldPass = document.getElementById('oldPassword');
const newPass = document.getElementById('newPassword');
const conNewPass = document.getElementById('confirmNewPassword');


function toggle() {
    dropDown.classList.toggle('active');
}

function openClose() {
    reviewDetail.classList.toggle('active');
}

function toggleEye() {
    if (eye.classList == 'fal fa-eye-slash') (
        eye.classList = 'fal fa-eye',
        oldPass.type = 'text'
    ); else if (eye.classList = 'fal fa-eye') {
        eye.classList = 'fal fa-eye-slash'
        oldPass.type = 'password'
    }
}

function toggleEyee() {
    if (eyee.classList == 'fal fa-eye-slash') (
        eyee.classList = 'fal fa-eye',
        newPass.type = 'text'
    ); else if (eye.classList = 'fal fa-eye') {
        eye.classList = 'fal fa-eye-slash'
        newPass.type = 'password'
    }
}
function toggleEyeee() {
    if (eyeee.classList == 'fal fa-eye-slash') (
        eyeee.classList = 'fal fa-eye',
        conNewPass.type = 'text'
    ); else if (eye.classList = 'fal fa-eye') {
        eye.classList = 'fal fa-eye-slash'
        conNewPass.type = 'password'
    }
}


// RESET POP-UP

const reset = document.getElementById('reset');
const spanName = document.getElementById('nameSpan');
const spanEmail = document.getElementById('emailSpan');
const sendEmail = document.getElementById('sendEmail');

function toggleReset(name, email) {
    reset.classList.toggle('active');
    spanName.innerHTML = name;
    spanEmail.innerHTML = email;
    sendEmail.value = email;
}