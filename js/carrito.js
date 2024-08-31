$(document).ready(function() {
    // Llama a la función para cargar el carrito al iniciar
    loadCart();

    function loadCart() {
        $.ajax({
            url: '../PHP/Carrito.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    console.error('Error:', data.error);
                    return;
                }

                let total = data.total;
                const $tableBody = $('#carrito-table-body');
                $tableBody.empty();

                data.items.forEach(function(item) {
                    const row = `
                        <tr>
                            <td>${item.nombre}</td>
                            <td>$${item.precio.toFixed(2)}</td>
                            <td>${item.cantidad}</td>
                            <td>$${item.total.toFixed(2)}</td>
                        </tr>
                    `;
                    $tableBody.append(row);
                });

                $('#total-price').text(`$${total.toFixed(2)}`);
            },
            error: function(xhr, status, error) {
                console.error('Error en la llamada AJAX:', error);
                alert('Error en la llamada AJAX.');
            }
        });
    }

    $('#confirmar-pedido-btn').on('click', function() {
        $.ajax({
            url: '../PHP/ConfirmarPedido.php',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = './Gracias.php'; // Redirige a la página de agradecimiento
                } else {
                    alert(response.error); // Muestra el mensaje de error
                }
            },
            error: function(xhr, status, error) {
                console.log('Status:', status);
                console.log('Error:', error);
                console.log('Response:', xhr.responseText);
                alert('Error al confirmar el pedido. Por favor, inténtalo de nuevo.');
            }
        });
    });

});
