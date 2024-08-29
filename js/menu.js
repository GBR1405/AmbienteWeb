$(document).ready(function() {
    $.ajax({
        url: 'php/Obtener_Tablas.php',
        method: 'GET',
        data: { accion: 'obtener_productos' },
        success: function(response) {
            // Renderiza los productos en la página
            let productosContainer = $('#productos-container');
            productosContainer.empty();

            response.forEach(function(producto) {
                productosContainer.append(`
                    <div class="producto-item">
                        <h3>${producto.nombre}</h3>
                        <p>Precio: $${producto.precio}</p>
                        <p>Categoría: ${producto.categoria}</p>
                    </div>
                `);
            });
        }
    });
});
