$(document).ready(function() {
    // Abre el modal
    $('#agregar-producto-btn').on('click', function() {
        $('#agregar-producto-modal').show();
        cargarProductos();
    });

    // Cierra el modal
    $('.close').on('click', function() {
        $('#agregar-producto-modal').hide();
    });

    // Cierra el modal cuando se hace clic fuera del modal
    $(window).on('click', function(event) {
        if ($(event.target).is('#agregar-producto-modal')) {
            $('#agregar-producto-modal').hide();
        }
    });

    // Cargar productos en el modal
    function cargarProductos() {
        $.ajax({
            url: '../PHP/obtenerProductos.php', // Asegúrate de que esta ruta sea correcta
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.productos && Array.isArray(data.productos)) {
                    const productoSelect = $('#producto-select');
                    productoSelect.empty(); // Limpiar el contenido actual del select
                    data.productos.forEach(function(producto) {
                        const option = $('<option>', {
                            value: producto.ID_Producto,
                            text: producto.Nombre
                        });
                        productoSelect.append(option);
                    });
                } else {
                    console.error('Error: Datos de productos no disponibles.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
            }
        });
        
    }

    // Manejar el formulario de agregar producto
    $('#agregar-producto-form').on('submit', function(event) {
        event.preventDefault();
        const idProducto = $('#producto-select').val();
        
        $.ajax({
            url: '../PHP/agregarProductoInventario.php',
            method: 'POST',
            data: { id_producto: idProducto },
            success: function(response) {
                alert(response);
                $('#agregar-producto-modal').hide();
                location.reload(); // Recargar la página para actualizar la tabla
            },
            error: function() {
                console.error('Error al agregar el producto.');
            }
        });
    });
});
