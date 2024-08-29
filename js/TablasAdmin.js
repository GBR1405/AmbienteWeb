$(document).ready(function () {
    // Manejar la carga de la tabla correspondiente al hacer clic en un botón
    $('.btn-tabla').on('click', function () {
        let tabla = $(this).data('tabla');
        cargarTabla(tabla);
    });

    // Manejar la carga del formulario de inserción
    $('.btn-insertar').on('click', function () {
        let tabla = $(this).data('tabla');
        mostrarFormularioInsercion(tabla);
    });

    function cargarTabla(tabla) {
        $.ajax({
            url: '../php/TablasAdmin.php',
            type: 'POST',
            data: { accion: 'cargar_tabla', tabla: tabla },
            success: function (data) {
                $('#table-container').html(data);
            },
            error: function () {
                alert('Error al cargar la tabla.');
            }
        });
    }

    function mostrarFormularioInsercion(tabla) {
        $.ajax({
            url: '../php/TablasAdmin.php',
            type: 'POST',
            data: { accion: 'mostrar_formulario_insercion', tabla: tabla },
            success: function (data) {
                $('#modal-body').html(data);
                $('#modal-form').modal('show');
            },
            error: function () {
                alert('Error al mostrar el formulario de inserción.');
            }
        });
    }

    // Manejar la inserción y edición de datos desde el formulario
    $(document).on('submit', '.formulario-insertar', function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: '../php/TablasAdmin.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                alert('Dato guardado correctamente.');
                $('#modal-form').modal('hide');
                $('.btn-tabla[data-tabla="' + $('input[name="tabla"]').val() + '"]').trigger('click'); // Refresh the table view
            },
            error: function () {
                alert('Error al guardar el dato.');
            }
        });
    });

    $(document).on('click', '.btn-editar', function() {
        let tabla = $(this).data('tabla');
        let id = $(this).data('id');

        $.ajax({
            url: '../php/TablasAdmin.php',
            type: 'POST',
            data: {
                accion: 'editar_fila',
                tabla: tabla,
                id: id
            },
            success: function (data) {
                $('#modal-body').html(data);
                $('#modal-form').modal('show');
            },
            error: function () {
                alert('Error al mostrar el formulario de edición.');
            }
        });
    });

    // Manejar la actualización de datos desde el formulario de edición
    $(document).on('submit', '.formulario-editar', function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: '../php/TablasAdmin.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                alert('Dato actualizado correctamente.');
                $('#modal-form').modal('hide');
                $('.btn-tabla[data-tabla="' + $('input[name="tabla"]').val() + '"]').trigger('click'); // Refresh the table view
            },
            error: function () {
                alert('Error al actualizar el dato.');
            }
        });
    });
});
