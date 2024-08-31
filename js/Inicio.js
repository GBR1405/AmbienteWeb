$(document).ready(function() {
    $('#loginButton').click(function() {
        var username = $('#username').val();
        var password = $('#password').val();

        // Verifica si los campos están llenos
        if (username === '' || password === '') {
            alert('Por favor, llena todos los campos.');
            return;
        }

        // Recopila los datos del formulario
        var formData = $('#loginForm').serialize();

        $.ajax({
            url: '../PHP/login.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response === 'success') {
                    // Redirige a la página principal
                    window.location.href = '../PHP/index.php';
                } else {
                    alert(response);
                }
            },
            error: function(xhr, status, error) {
                alert('Hubo un error: ' + error);
            }
        });
    });
});
