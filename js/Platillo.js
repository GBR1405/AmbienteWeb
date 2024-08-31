$(document).ready(function() {
    // Manejar clic en el botón para agregar platillo
    $('#add-dish-btn').click(function() {
        $('#addDishModal').modal('show');
    });

    // Cargar datos del usuario y los platillos
    $.ajax({
        url: '../PHP/get_user_data.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.Username) {
                $('#nombre_usuario').text(data.Username);
            } else {
                console.error('Error: Nombre de usuario no disponible.');
            }

            if (Array.isArray(data.platillos)) {
                const productList = $('#product-list');
                productList.empty(); // Asegúrate de que productList es un objeto jQuery
                data.platillos.forEach(function(platillo) {
                    const div = $('<div>', {
                        class: 'product-item'
                    });
                    div.html(`
                        <img src="${platillo.Imagen}" alt="${platillo.Nombre}" style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="product-info">
                            <h3>${platillo.Nombre}</h3>
                            <p class="price">$${platillo.Precio.toFixed(2)}</p>
                            <p class="description">${platillo.Descripcion}</p>
                        </div>
                        <button class="edit-dish btn btn-secondary" data-id="${platillo.ID_Platillo}">Editar</button>
                    `);
                    productList.append(div);
                });
            } else {
                console.error('Error: Datos de platillos no válidos o vacíos.');
            }

            // Carga de categorías en el modal
            $.ajax({
                url: '../PHP/get_categories.php',
                method: 'GET',
                dataType: 'json',
                success: function(categories) {
                    const categorySelect = $('#dishCategory');
                    categorySelect.empty(); // Asegúrate de que categorySelect es un objeto jQuery
                    if (Array.isArray(categories)) {
                        categories.forEach(function(categoria) {
                            categorySelect.append(new Option(categoria.Categoria, categoria.ID_Categoria));
                        });
                    } else {
                        console.error('Error: Datos de categorías no válidos o vacíos.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error al cargar las categorías:', textStatus, errorThrown);
                }
            });

            if (data.ID_Restaurante) {
                $('#restaurantId').val(data.ID_Restaurante);
            } else {
                console.error('Error: ID del restaurante no disponible.');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error al cargar los datos:', textStatus, errorThrown);
            console.error('Respuesta del servidor:', jqXHR.responseText);
        }
    });

    console.log('Se está adjuntando el manejador de eventos'); // Añade este log para verificar si se está ejecutando varias veces

    $('#addDishForm').off('submit').on('submit', function(e) {
        e.preventDefault();
        console.log('Formulario enviado'); // Verifica cuántas veces se está enviando
        const formData = $(this).serialize();
        
        $.ajax({
            url: '../PHP/add_dish.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log('Respuesta del servidor:', response); // Verifica la respuesta del servidor
                alert('Platillo agregado exitosamente');
                $('#addDishModal').modal('hide');
                $('#addDishForm')[0].reset();
                location.reload(); // Recargar la página para mostrar el nuevo platillo
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error al agregar el platillo:', textStatus, errorThrown);
                console.error('Respuesta del servidor:', jqXHR.responseText); // Muestra la respuesta del servidor en caso de error
                alert('Error al agregar el platillo. Por favor, intente nuevamente.');
            }
        });
    });
});
