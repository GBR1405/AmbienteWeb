document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Validación de Nombre
    const nombre = document.getElementById('nombre').value;
    const firstNameError = document.getElementById('firstNameError');
    if (firstName === '') {
        firstNameError.textContent = 'The text field is required.';
    } else {
        firstNameError.textContent = '';
    }

    // Validación de Apellido
    const lastName = document.getElementById('lastName').value;
    const lastNameError = document.getElementById('lastNameError');
    if (lastName === '') {
        lastNameError.textContent = 'The text field is required.';
    } else {
        lastNameError.textContent = '';
    }

    // Validación de Correo Electrónico
    const email = document.getElementById('email').value;
    const emailError = document.getElementById('emailError');
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        emailError.textContent = 'Please enter a valid email address.';
    } else {
        emailError.textContent = '';
    }

    // Validación de Mensaje
    const message = document.getElementById('message').value;
    const messageError = document.getElementById('messageError');
    if (message === '') {
        messageError.textContent = 'The text field is required.';
    } else {
        messageError.textContent = '';
    }

    // Verificación de errores
    if (firstNameError.textContent === '' && lastNameError.textContent === '' && emailError.textContent === '' && messageError.textContent === '') {
        alert('Form submitted successfully!');
        document.getElementById('contactForm').reset();
    }




});












