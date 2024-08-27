$(document).ready(function() {

    console.log('Loading genres from ../PHP/load_generos.php'); 


    $.ajax({
        url: '../PHP/load_generos.php',
        type: 'GET',
        success: function(data) {
            $('#genero').html(data);
        },
        error: function(xhr, status, error) {
            alert('Error al cargar los géneros: ' + error);
        }
    });

    $('#registerButton').click(function() {
        var formData = $('#registrationForm').serialize();

        $.ajax({
            url: '../PHP/register.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                alert('usuario Registrado')
                window.location.href = '../PHP/inicio_sesion.php';
            },
            error: function(xhr, status, error) {
                alert('Hubo un error: ' + error);
            }
        });
    });
});
