$(document).ready(function() {
    // Cargar restaurantes
    loadRestaurants();

    // Mostrar modal de agregar restaurante
    $('#add-restaurant-btn').on('click', function() {
        loadSelectData();
        $('#add-restaurant-modal').modal('show');
    });

    // Enviar formulario de agregar restaurante
    $('#add-restaurant-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'AddRestaurant.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                $('#add-restaurant-modal').modal('hide');
                loadRestaurants();
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX:', status, error);
            }
        });
    });

    function loadRestaurants() {
        $.ajax({
            url: 'GetRest.php',
            type: 'GET',
            success: function(response) {
                $('#restaurant-table-body').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX:', status, error);
            }
        });
    }

    function loadSelectData() {
        $('#user').html('<option>Cargando...</option>');
        $('#especializacion').html('<option>Cargando...</option>');
        $('#pais').html('<option>Cargando...</option>');
        $('#estado').html('<option>Cargando...</option>');

        $.ajax({
            url: 'GetSelectData.php',
            type: 'GET',
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    
                    if (data.users && data.especializaciones && data.paises && data.estados) {
                        $('#user').html(data.users.map(u => `<option value="${u.ID_Usuario}">${u.Username}</option>`).join(''));
                        $('#especializacion').html(data.especializaciones.map(e => `<option value="${e.ID_Especializacion_Restaurante}">${e.Especializacion}</option>`).join(''));
                        $('#pais').html(data.paises.map(p => `<option value="${p.ID_Pais}">${p.Pais}</option>`).join(''));
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
});
