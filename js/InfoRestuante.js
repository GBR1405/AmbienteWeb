$(document).ready(function() {
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
                productList.empty();
                data.platillos.forEach(function(platillo) {
                    const div = $('<div>', { class: 'product-item' });
                    div.html(`
                        <img src="https://via.placeholder.com/100x100" alt="${platillo.Nombre}">
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
                    categorySelect.empty();
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
    

    // Manejar clic en el botón para agregar platillo
    $('#add-dish-btn').click(function() {
        $('#addDishModal').modal('show');
    });

    // Manejar envío del formulario de agregar platillo
    $('#addDishForm').submit(function(event) {
        event.preventDefault();

        const dishData = {
            nombre: $('#dishName').val(),
            descripcion: $('#dishDescription').val(),
            categoria: $('#dishCategory').val(),
            precio: $('#dishPrice').val(),
            imagen: $('#dishImage').val(),
            restauranteId: $('#restaurantId').val()
        };

        $.ajax({
            url: '../PHP/add_dish.php',
            method: 'POST',
            data: dishData,
            success: function(response) {
                alert('Platillo agregado exitosamente.');
                $('#addDishModal').modal('hide');
                location.reload(); // Recargar la página para ver el nuevo platillo
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error al agregar el platillo:', textStatus, errorThrown);
            }
        });
    });

    $('#product-list').on('click', '.edit-dish', function() {
        const dishId = $(this).data('id');

        // Realizar una solicitud AJAX para obtener los datos del platillo
        $.ajax({
            url: '../PHP/get_dish.php', // Asegúrate de tener un script PHP que devuelva los datos del platillo
            method: 'GET',
            data: { id: dishId }, // Enviar el ID del platillo al servidor
            dataType: 'json',
            success: function(platillo) {
                if (platillo) {
                    // Rellenar el modal con los datos del platillo
                    $('#editDishId').val(platillo.ID_Platillo); // Este campo está oculto
                    $('#editDishName').val(platillo.Nombre);
                    $('#editDishPrice').val(platillo.Precio);
                    $('#editDishDescription').val(platillo.Descripcion);
                    $('#editDishImage').val(platillo.Imagen);

                    // Cargar categorías en el select
                    $.ajax({
                        url: '../PHP/get_categories.php',
                        method: 'GET',
                        dataType: 'json',
                        success: function(categories) {
                            const categorySelect = $('#editDishCategory');
                            categorySelect.empty(); // Asegúrate de que categorySelect es un objeto jQuery
                            if (Array.isArray(categories)) {
                                categories.forEach(function(categoria) {
                                    const option = new Option(categoria.Categoria, categoria.ID_Categoria);
                                    if (categoria.ID_Categoria == platillo.ID_Categoria) {
                                        option.selected = true;
                                    }
                                    categorySelect.append(option);
                                });
                            } else {
                                console.error('Error: Datos de categorías no válidos o vacíos.');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error al cargar las categorías:', textStatus, errorThrown);
                        }
                    });

                    // Mostrar el modal
                    $('#editDishModal').modal('show');
                } else {
                    console.error('Error: Platillo no encontrado.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error al obtener los datos del platillo:', textStatus, errorThrown);
            }
        });
    });

    // Manejador para guardar cambios del platillo
    $('#editDishForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: '../PHP/update_dish.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log('Respuesta del servidor:', response);
                alert('Platillo actualizado exitosamente');
                $('#editDishModal').modal('hide');
                location.reload(); // Recargar la página para mostrar los cambios
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error al actualizar el platillo:', textStatus, errorThrown);
                alert('Error al actualizar el platillo. Por favor, intente nuevamente.');
            }
        });
    });
});
