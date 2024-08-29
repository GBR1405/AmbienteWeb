$(document).ready(function() {
    $('.ver-mas').on('click', function() {
        var idPedido = $(this).data('id');
        
        $.ajax({
            url: '../PHP/historial.php',
            type: 'POST',
            dataType: 'json',
            data: { id_pedido: idPedido },
            success: function(response) {
                if (response.success) {
                    var detalles = response.detalles;
                    var tbody = $('#detallePedidoBody');
                    tbody.empty(); // Limpiar el contenido anterior
                    
                    detalles.forEach(function(detalle) {
                        tbody.append(
                            '<tr>' +
                            '<td>' + detalle.Nombre + '</td>' +
                            '<td>' + detalle.Cantidad + '</td>' +
                            '</tr>'
                        );
                    });
                    
                    $('#detallePedidoModal').modal('show'); // Mostrar el modal
                } else {
                    alert(response.error);
                }
            },
            error: function() {
                alert('Error al cargar los detalles del pedido. Por favor, inténtalo de nuevo.');
            }
        });
    });
});
