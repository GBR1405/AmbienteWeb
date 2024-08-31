function cargarPedidos() {
    $.ajax({
        url: '../PHP/pedidos.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                let pedidosHtml = '';
                response.pedidos.forEach(function(pedido) {
                    pedidosHtml += `
                        <div class="col-md-6 mb-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Pedido ID: ${pedido.ID_Pedido}</h5>
                                    <p class="card-text">Estado: ${pedido.Estado}</p>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-success me-2 estado-btn-completado" data-id="${pedido.ID_Pedido}" data-estado="4">Marcar como Completado</button>
                                    <button class="btn btn-danger estado-btn-cancelado" data-id="${pedido.ID_Pedido}" data-estado="6">Marcar como Cancelado</button>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $('#pedidos-container').html(pedidosHtml);
            } else {
                alert('Error al cargar los pedidos: ' + response.error);
            }
        },
        error: function() {
            alert('Error al conectar con el servidor.');
        }
    });
}

function cargarHistorialPedidos() {
    $.ajax({
        url: '../PHP/PedidoHisto.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                let historialHtml = '';
                response.pedidos.forEach(function(pedido) {
                    historialHtml += `
                        <div class="col-md-6 mb-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Pedido ID: ${pedido.ID_Pedido}</h5>
                                    <p class="card-text">Estado: ${pedido.Estado}</p>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $('#historial-pedidos-container').html(historialHtml);
            } else {
                alert('Error al cargar el historial de pedidos: ' + response.error);
            }
        },
        error: function() {
            alert('Error al conectar con el servidor.');
        }
    });
}


$(document).ready(function() {
    cargarPedidos();
    cargarHistorialPedidos();

    // Manejador para el botón "Completado"
    $(document).on('click', '.estado-btn-completado', function() {
        const idPedido = $(this).data('id');
        const estado = 4; // Estado para completado

        alert(`ID del Pedido: ${idPedido}, Estado: ${estado}`);

        actualizarEstadoPedido(idPedido, estado);
    });

    // Manejador para el botón "Cancelado"
    $(document).on('click', '.estado-btn-cancelado', function() {
        const idPedido = $(this).data('id');
        const estado = 6; // Estado para cancelado

        alert(`ID del Pedido: ${idPedido}, Estado: ${estado}`);

        actualizarEstadoPedido(idPedido, estado);
    });
});

// Función para actualizar el estado del pedido
function actualizarEstadoPedido(idPedido, estado) {
    $.ajax({
        url: '../PHP/PedidoActu.php',
        type: 'POST',
        data: { id_pedido: idPedido, estado: estado },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Estado del pedido actualizado');
                cargarPedidos();
                cargarHistorialPedidos();
            } else {
                alert('Error al actualizar el estado: ' + response.error);
            }
        },
    });
}

