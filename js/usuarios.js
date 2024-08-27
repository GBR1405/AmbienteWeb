$(document).ready(function() {
    // Cargar usuarios
    loadUsers();

    // Mostrar modal de agregar usuario
    $('#add-user-btn').on('click', function() {
        $('#add-user-modal').modal('show');
    });

    // Enviar formulario de agregar usuario
    $('#add-user-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'agregar_usuario.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#add-user-modal').modal('hide');
                loadUsers(); // Recargar usuarios
            }
        });
    });

    function loadUsers() {
        $.ajax({
            url: 'get_usuarios.php',
            type: 'GET',
            success: function(response) {
                $('#user-table-body').html(response);
            }
        });
    }
});
