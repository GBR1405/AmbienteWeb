$(document).ready(function() {
    // Cargar usuarios
    loadUsers();

    // Mostrar modal de agregar usuario
    $('#add-user-btn').on('click', function() {
        loadSelectDataA(); // Carga los datos para el modal de agregar
        $('#add-user-modal').modal('show');
    });

    // Mostrar modal de editar usuario
    $(document).on('click', '.edit-btn', function() {
        var userId = $(this).data('id');
        loadUserData(userId); // Carga los datos del usuario
        loadSelectData(); // Carga los datos para los select list
        $('#edit-user-modal').modal('show');
    });

    // Enviar formulario de agregar usuario
    $('#add-user-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '../PHP/AddUser.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                $('#add-user-modal').modal('hide');
                loadUsers();
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX:', status, error);
            }
        });
    });

    // Enviar formulario de editar usuario
    $('#edit-user-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '../PHP/EditUser.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                $('#edit-user-modal').modal('hide');
                loadUsers();
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX:', status, error);
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

    function loadSelectData() {
        $('#edit-genero').html('<option>Cargando...</option>');
        $('#edit-rol').html('<option>Cargando...</option>');
        $('#edit-estado').html('<option>Cargando...</option>');
    
        $.ajax({
            url: '../PHP/get_select_data.php',
            type: 'GET',
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    
                    if (data.generos && data.roles && data.estados) {
                        $('#edit-genero').html(data.generos.map(g => `<option value="${g.ID_Genero}">${g.Nombre_Genero}</option>`).join(''));
                        $('#edit-rol').html(data.roles.map(r => `<option value="${r.ID_Rol}">${r.Rol}</option>`).join(''));
                        $('#edit-estado').html(data.estados.map(e => `<option value="${e.ID_Estado}">${e.Estado}</option>`).join(''));
                    } else {
                        console.error('Datos faltantes en la respuesta:', data);
                    }
                } catch (error) {
                    console.error('Error al parsear la respuesta JSON:', error, response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX:', status, error);
            }
        });
    }

    function loadSelectDataA() {
        $('#genero').html('<option>Cargando...</option>');
        $('#rol').html('<option>Cargando...</option>');
        $('#estado').html('<option>Cargando...</option>');
    
        $.ajax({
            url: '../PHP/get_select_data.php',
            type: 'GET',
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    
                    if (data.generos && data.roles && data.estados) {
                        $('#genero').html(data.generos.map(g => `<option value="${g.ID_Genero}">${g.Nombre_Genero}</option>`).join(''));
                        $('#rol').html(data.roles.map(r => `<option value="${r.ID_Rol}">${r.Rol}</option>`).join(''));
                        $('#estado').html(data.estados.map(e => `<option value="${e.ID_Estado}">${e.Estado}</option>`).join(''));
                    } else {
                        console.error('Datos faltantes en la respuesta:', data);
                    }
                } catch (error) {
                    console.error('Error al parsear la respuesta JSON:', error, response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX:', status, error);
            }
        });
    }

    function loadUserData(userId) {
        $.ajax({
            url: '../PHP/GetUserData.php',
            type: 'GET',
            data: { id: userId },
            success: function(response) {
                try {
                    const user = JSON.parse(response);
                    $('#edit-username').val(user.Username);
                    $('#edit-nombre').val(user.Nombre);
                    $('#edit-apellido').val(user.Apellido);
                    $('#edit-email').val(user.Email);
                    $('#edit-telefono').val(user.Telefono);
                    $('#edit-genero').val(user.ID_Genero);
                    $('#edit-rol').val(user.ID_Rol);
                    $('#edit-estado').val(user.ID_Estado);
                    $('#edit-user-id').val(user.ID_Usuario); // Asegúrate de tener un campo oculto para el ID del usuario
                } catch (error) {
                    console.error('Error al parsear la respuesta JSON:', error, response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX:', status, error);
            }
        });
    }
});
