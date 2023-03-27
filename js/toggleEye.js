const eye = document.getElementById('view');
const eyee = document.getElementById('vieww');

function toggleEye() {
    eye.classList.toggle("fa-eye-slash");
    const password = document.getElementById('password');

    if (eye == "fal fa-eye") {
        // console.log('closed')
        password.type = "password"
    } else {
        // console.log('opened')
        password.type = "text";
    }
}

function toggleEyee() {
    eyee.classList.toggle("fa-eye-slash");
    const password = document.getElementById('confirmPassword');

    if (eyee == "fal fa-eye") {
        // console.log('closed')
        password.type = "password"
    } else {
        // console.log('opened')
        password.type = "text";
    }
}